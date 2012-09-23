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

        $user = new MUser();
        $userFull = new MUserFull();
        $user->scenario = 'registration';
        $userFull->scenario = 'registration';

        if(isset($_POST['MUser']) && isset($_POST['MUserFull'])) {
            $user->attributes = $_POST['MUser'];
            $userFull->attributes = $_POST['MUserFull'];

            if($this->multipleValidate(array($user, $userFull))) {
                $user->password = $user->passwordCript($user->password);
                $user->save(false);

                $userFull->id = $user->id;
                $userFull->save(false);

                $this->checkEmail($user->id, $userFull->email);
                $this->redirect(Yii::app()->createUrl('user/index/registrationOk'));
            }
        }

        $this->render('registration', array(
            'user' => $user,
            'userFull' => $userFull,
        ));
    }

    /**
     * Окончание регистрации нового пользоватлея.
     * @see self::actionRegistration()
     * @return void
     */
    public function actionRegistrationOk()
    {
        $this->render('registrationOk');
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
     * Подтверждение e-mail адреса.
     * Переход на страницу осуществляется из письма.
     * @param int $user Id пользователя
     * @param int $solt Соль дял проверки
     * @return void
     */
    public function actionEmailConfirm($user, $solt)
	{
		$user = (int)$_GET['user'];
		$solt = (int)$_GET['solt'];

        $record = $sql = Yii::app()->db->createCommand("
            SELECT
                t.id,
                t.user,
                t.email
            FROM
                user_confirm_email AS t
            WHERE
                t.user = {$user}
            AND t.solt = {$solt}
        ")->queryRow();

        if(isset($record) && $record != null) {
            // Удаляем запись из вспомогательной таблицы.
            Yii::app()->db->createCommand("
                DELETE FROM user_confirm_email WHERE id = {$record['id']}
            ")->execute();

            // Активируем пользователя.
            Yii::app()->db->createCommand("
                UPDATE user SET is_confirm = 1 WHERE id = {$record['user']}
            ")->execute();

            // Обновляем адрес почты.
            Yii::app()->db->createCommand("
                UPDATE user_full SET email = '{$record['email']}' WHERE id = {$record['user']}
            ")->execute();

            $this->redirect(Yii::app()->homeUrl);
        } else {
            throw new CHttpException(404, self::EXCEPTION_WRONG_ADDRESS);
        }
	}

    /**
     * @see Controller::createPageParams()
     */
    protected function createPageParams()
    {

    }

    /**
     * Проверка существования указанного e-mail адреса.
     * @param int $userId Id пользователя, меняющего email
	 * @param string $email Проверяемый адрес
	 * @return void
	 */
	protected function checkEmail($userId, $email)
	{
        $record = new MUserConfirmEmail();
		$record->user = $userId;
		$record->email = $email;
		$record->solt = LNumber::generateNumber();
		$record->save();
	}
}