<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends FrontController
{
    /**
     * Регистрация нового пользователя.
     * @return void
     */
    public function actionRegistration()
    {
        if(!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->homeUrl);

        if(isset($_POST['MUser'])) {

        }

        $this->render('registration', array(

        ));
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