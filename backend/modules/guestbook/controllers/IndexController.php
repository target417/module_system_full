<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends BackController
{
    /**
     * Главная страница модуля.
     * Содержит сообщения гостевой книни и ссылки для их редактирования.
     */
    public function actionIndex()
    {
        $messagesList = $this->loadMessagesList();

        $this->render('index', array(
            'messagesList' => $messagesList[0],
            'pages' => $messagesList[1],
        ));
    }

    /**
     * Редактирование сообщения.
     * @param int @id Id редактируемого сообщения.
     * @return void
     */
    public function actionEditMessage($id)
    {
        $id = (int)$id;

        if(!$message = MGuestbook::model()->findByPk($id))
            throw new CHttpException(404, self::EXC_WRONG_ADDRESS);

        $message->scenario = 'editMessage';

        if(isset($_POST['MGuestbook'])) {
            if(Yii::app()->user->checkAccess('guestbook_admin_message_author'))
                $message->author = $_POST['MGuestbook']['author'];
            if(Yii::app()->user->checkAccess('guestbook_admin_message_text'))
                $message->text = $_POST['MGuestbook']['text'];
            if(Yii::app()->user->checkAccess('guestbook_admin_message_answer'))
                $message->answer = $_POST['MGuestbook']['answer'];

            if($message->save())
                $this->redirect(Yii::app()->createUrl('guestbook/index/index'));
        }

        $this->render('editMessage', array(
            'message' => $message,
        ));
    }

    /**
     * Удаление сообщения.
     * @param int $id Id удаляемого сообщения.
     * @return void
     */
    public function actionAjaxRemoveMessage($id)
    {
        $id = (int)$id;

        $sql = Yii::app()->db->createCommand("
            UPDATE
                guestbook
            SET
                is_remove = 1
            WHERE
                id = {$id}
        ");

        if($sql->execute())
            echo 'true';
        else
            echo 'false';
    }

    /**
     * Загрузка списка сообщений из БД.
     * @return array
     * 0 => Массив с сущностями сообщений
     * 1 => Экземпляр сдасса Pagination
     */
    protected function loadMessagesList()
    {
        $sql = Yii::app()->db->createCommand()
            ->select(array(
                't.id',
                't.author',
                't.text',
                't.answer',
                't.date_create AS dateCreate',
            ))
            ->from(array(
                'guestbook AS t',
            ))
            ->where('t.is_remove = 0')
            ->order('t.date_create DESC');

        // Разделяем на страницы.
        $countSql = clone $sql;
        $count = $countSql->select('COUNT(t.id)')->queryScalar();
        $pages = new CPagination($count);
        $pages->pageSize = $this->module->getParams()->messagesOnPage;
        $sql->limit($pages->pageSize, $pages->currentPage * $pages->pageSize);

        $result = $sql->queryAll();

        // Формируем сущности.
        while($item = each($result)) {
            $message = new EMessage();
            $message->attributes = $item[1];
            $return[] = $message;
        }

        return array($return, $pages);
    }

    /**
     * @see Conctroller::createPageParams()
     */
    protected function createPageParams()
    {
        switch($this->action->id) {
            case 'index' :
                if(!Yii::app()->user->checkAccess('guestbook_access_cms'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;

            case 'editmessage' :
                if(!Yii::app()->user->checkAccess('guestbook_admin_message'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;

            case 'ajaxRemoveMessage':
                if(!Yii::app()->user->checkAccess('guestbook_admin_message_remove'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;
        }
    }
}