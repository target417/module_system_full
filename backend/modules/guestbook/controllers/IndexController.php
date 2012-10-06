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
            'messagesList' => $messagesList,
        ));
    }

    /**
     * Редактирование сообщения.
     * @param int @id Id редактируемого сообщения.
     * @return void
     */
    public function actioneditMessage($id)
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
     * Загрузка списка сообщений из БД.
     * @return array
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

        $result = $sql->queryAll();

        // Формируем сущности.
        while($item = each($result)) {
            $message = new EMessage();
            $message->attributes = $item[1];
            $return[] = $message;
        }

        return $return;
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
        }
    }
}