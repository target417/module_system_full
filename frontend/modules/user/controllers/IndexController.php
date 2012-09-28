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
        $user->scenario = $userFull->scenario = 'registration';

        if(isset($_POST['MUser'])) {
            $user->attributes = $_POST['MUser'];

            if($this->multipleValidate(array($user, $userFull))) {
                $user->password = $user->passwordCript($user->password);
                $user->save(false);

                $userFull->id = $user->id;
                $userFull->save(false);

                $this->checkEmail($user->id, $user->email);

                // Делаем запись о последнем посещении.
                Yii::app()->db->createCommand("
                INSERT INTO user_last_online(
                    `user`,
                    `last_online`)
                VALUES (
                    {$user->id},
                    NOW())
                ")->execute();

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
     * Профиль пользователя.
     * @param int $id Id пользователя
     * @return void
     */
    public function actionProfile($id = null)
    {
        // Присваеваем id пользователя.
        if($id !== null)
            $id = (int)$id;
        else if(!Yii::app()->user->isGuest)
            $id = Yii::app()->user->id;
        else
            throw new CHttpException(404, self::EXCEPTION_WRONG_ADDRESS);

        // Если это профиль текущего пользователя, кэширование не начинаем.
        if(!Yii::app()->user->isGuest && (Yii::app()->user->id === $id)) {
            $this->render('profile', array(
                'user' => $this->loadUserData($id),
            ));

        // Если профиль не принадлежит текущему пользователю, начинаем кэширование.
        } else {
            if($this->beginCache('userProfile', array(
                'cacheID' => 'memCache',
                'duration' => $this->module->cacheTime['profile'],
                'varyByParam' => array(
                    'id',
                ),
            ))) {
                $this->render('profile', array(
                    'user' => $this->loadUserData($id),
                ));

                $this->endCache();
            }
        }
    }

    /**
     * Редактирование профиля пользователя.
     * @return void
     */
    public function actionEditProfile()
    {
        $id = Yii::app()->user->id;

        $user = MUser::model()->findByPk($id);
		$userFull = MUserFull::model()->findByPk($id);
		$user->scenario = $userFull->scenario = 'editProfile';

        if(isset($_POST['MUser']) && isset($_POST['MUserFull'])) {
            $oldEmail = $user->email;
            $user->attributes = $_POST['MUser'];
            $userFull->attributes = $_POST['MUserFull'];

            if($this->multipleValidate(array($user, $userFull))) {
				// Если email был изменен - высылаем письмо с подтверждением..
				if($oldEmail != $user->email) {
					$this->checkEmail($id, $user->email);
					$user->email = $oldEmail;
				}

				// если был введен новый пароль - меняем его.
				if($user->oldPassword && $user->newPassword && $user->newPassword2)
					$user->password = $user->passwordCript($user->newPassword);

				// Удаляем аватар, если указанно.
                $avatarDir = $this->module->getParams()->avatarsDir . DIRECTORY_SEPARATOR . $user->id . '.jpg';

				if(!$_POST['deleteAvatar']) {
					if($user->img = CUploadedFile::getInstance($user, 'img')) {
						$user->img->saveAs($avatarDir);
					}
				} else {
					if(file_exists($avatarDir))
						unlink($avatarDir);
				}

				$user->save(false);
				$userFull->save(false);

				$this->redirect(Yii::app()->createUrl('user/index/profile'));
			}
        }

        $this->render('editProfile', array(
            'user' => $user,
            'userFull' => $userFull,
        ));
    }

    /**
     * Востановление забытого пароля.
     * @return void
     */
    public function actionRestorePassword()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->homeUrl);

		$user = new MUser();
		$user->scenario = 'restorePassword';

		if(isset($_POST['MUser'])) {
			$user->attributes = $_POST['MUser'];

			if($user->validate()) {
				$newPassword = LString::generateString(10);

                Yii::app()->db->createCommand("
                    UPDATE user SET password = '{$user->passwordCript($newPassword)}'
                    WHERE id = {$user->id}
                ")->execute();

				$this->redirect(Yii::app()->createUrl('user/index/restorePasswordOk'));
			}
		}

		$this->render('restorePassword', array(
			'user' => $user,
		));
	}

    /**
     * Окончание востановления забытого пароля.
     * @return void
     */
    public function actionrestorePasswordOk()
    {
        $this->render('restorePasswordOk');
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

            // Активируем пользователя и оновляем адрес.
            Yii::app()->db->createCommand("
                UPDATE user SET is_confirm = 1, email = '{$record['email']}' WHERE id = {$record['user']}
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
        switch($this->action->id) {
            case 'editProfile' :
                if(Yii::app()->user->isGuest)
                    $this->redirect(Yii::app()->user->loginUrl);
                break;
       }
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

    /**
     * Загрузка информации о пользователе.
     * @param int $id Id пользователя
     * @return array
     */
    protected function loadUserData($id)
    {
        $sql = Yii::app()->db->createCommand("
            SELECT
                t.id,
                t.login,
                rFull.date_reg,
                rFull.birthday,
                rFull.sex,
                rFull.name,
                rGroup.group,
                rGroup.style,
                rLastOnline.last_online
            FROM
                user as t,
                user_full as rFull,
                user_group as rGroup,
                user_last_online as rLastOnline
            WHERE
                t.id = {$id}
            AND t.is_confirm = 1
            AND t.is_remove = 0
            AND t.id = rFull.id
            AND t.group = rGroup.id
            AND t.id = rLastOnline.user
        ");
        if(!$record = $sql->queryRow())
            throw new CHttpException(404, self::EXCEPTION_WRONG_ADDRESS);

        // Формируем сущность.
        $user = new EUser();
        $user->id = $record['id'];
        $user->login = $record['login'];
        $user->sex = $record['sex'];
        $user->name = $record['name'];
        $user->birthday = $record['birthday'];
        $user->dateReg = $record['date_reg'];
        $user->group = array(
            'group' => $record['group'],
            'style' => $record['style'],
        );
        $user->lastOnline = $record['last_online'];

        return $user;
    }

    /**
     * Формирование пользовательского меню.
     * @see CController::renderDynamic()
     * @param int $id Id пользователя, чей профиль просматривается
     * @return string Код для отображения в представлении
     */
    protected function dynamicUserMenu($id)
    {
        return $this->renderPartial('dynamicUserMenu', array(
            'id' => $id,
        ), true);
    }
}