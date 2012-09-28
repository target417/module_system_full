<?php
/*
 * Входной контроллер административной части.
 */
final class Indexcontroller extends BackController
{
    /**
     * Входной экшен.
     * @return void
     */
    public function actionIndex()
    {
        echo 'BackEnd is start...';
    }

    /**
     * Вход в систему.
     * @return void
     */
    public function actionLogin()
    {
        if(!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl);

        $user = new MUser();
        $user->scenario = 'login';

        if(isset($_POST['MUser'])) {
            $user->attributes = $_POST['MUser'];

            if($user->validate())
                $this->redirect(Yii::app()->homeUrl);
        }

        $this->render('login', array(
            'user' => $user,
        ));
    }

    /**
     * Выход из системы.
     * @return void
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * @see Controller::createPageParams()
     */
    protected function createPageParams()
    {

    }
}