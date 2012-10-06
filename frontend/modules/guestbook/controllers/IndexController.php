<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends Frontcontroller
{
    /**
     * Страница с сообщениями.
     * @return void
     */
    public function actionIndex()
    {
        $messagesList = $this->loadMessagesList();

        $this->render('index', array(
            'messagesList' => $messagesList,
        ));
    }

    /**
     * Добавление нового сообщения.
     * @return void
     */
    public function actionAddMessage()
    {
        $message = new MGuestbook();
        $message->scenario = 'addMessage';

        if(isset($_POST['MGuestbook'])) {
            $message->attributes = $_POST['MGuestbook'];

            if($message->save())
                $this->redirect(Yii::app()->createUrl('guestbook/index/index'));
        }

        $this->render('addMessage', array(
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
     * @see Controller::createPageParams()
     */
    protected function createPageParams()
    {
        switch($this->action->id) {
            case 'index' :
                break;

            case 'addmessage':
                break;
        }
    }
}