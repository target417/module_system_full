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
        $this->render('index');
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

            if($message->save()) {
                $this->redirect(Yii::app()->createUrl('guestbook/index/index'));
            }

        }

        $this->render('addMessage', array(
            'message' => $message,
        ));
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