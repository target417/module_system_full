<?php
/**
 * Пользователи. Основная таблица.
 *
   CREATE TABLE `user` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `login` VARCHAR( 20 ) NOT NULL ,
   `password` VARCHAR( 32 ) NOT NULL ,
   `email` VARCHAR( 100 ) NOT NULL ,
    `group` INT UNSIGNED NOY NULL ,
   `theme` TINYINT UNSIGNED NULL ,
   `cookies_solt` INT UNSIGNED NULL ,
   `is_confirm` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
   `is_remove` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'
   ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
 */
class MUser extends ActiveRecord
{
    /**
     * Поле "запомнить меня".
     * @var bool
     */
    public $saveMe;

    /**
	 * Текущий пароль.
	 * @var string
	 */
	public $oldPassword;

	/**
	 * Новый пароль.
	 * @var string
	 */
	public $newPassword;

	/**
	 * повторный ввод нового пароля.
	 * @var string
	 */
	public $newPassword2;

	/**
	 * Файл аватара пользователя.
	 * @var file
	 */
	public $img;

    /**
     * Капча.
     * @var string
     */
    public $verifyCode;

    /**
     * @see CActiveRecord::model()
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @see CActiveRecord::tableName()
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @see CActiveRecord::rules()
     */
    public function rules()
    {
        return array(
            array('login', 'length', 'min' => 6, 'max' => 16),
            array('login', 'match', 'pattern' => '/^([a-z0-9 _\-]+|[а-я0-9 _\-]+)$/iu'),

            array('password, newPassword', 'length', 'min' => 6),

            array('email', 'length', 'max' => 100),
            array('email', 'match', 'pattern' => '/^[a-z0-9\-_\.]+@[a-z0-9\-_\.]+.[a-z]{2,5}$/iu'),

            array('is_confirm, is_remove', 'default', 'value' => 0),

            array('theme', 'in', 'range' => $this->getThemesList('id')),
            array('theme', 'default', 'value' => $this->getDefaultTheme()),

            array('group', 'default', 'value' => MUserGroup::getDefault()),

            array('saveMe', 'numerical'),

            array('img', 'ImageValidator', 'mime' => array('image/jpg', 'image/jpeg'), 'maxWidth' => 150, 'maxHeight' => 150),

            // Регистрация нового пользователя.
            array('login, email, password', 'required', 'on' => 'registration'),
            array('login, email', 'unique', 'on' => 'registration'),
			array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'registration'),

            // Вход в систему.
            array('login, password', 'required', 'on' => 'login'),
			array('password', 'authenticate', 'on' => 'login'),

            // Востановление пароля.
            array('login, email, verifyCode', 'required', 'on' => 'restorePassword'),
			array('login', 'checkUserByEmail', 'on' => 'restorePassword'),
			array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'restorePassword'),

            // Редактирвоание личных данных.
			array('email', 'required', 'on' => 'editProfile'),
			array('email', 'unique', 'on' => 'editProfile'),

			array('newPassword2', 'compare', 'compareAttribute'=>'newPassword', 'on' => 'editProfile'),
			array('oldPassword', 'checkOldPassword', 'on' => 'editProfile'),
        );
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'E-mail',
            'group' => 'Группа',
            'theme' => 'Тема оформления',
            'is_confirm' => 'Активирован',
            'is_remove' => 'Удален',
            'save_me' => 'Запомнить меня',
            'verifyCode' => 'Код проверки',
            'img' => 'Аватар',
            'oldPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'newPassword2' => 'Повтор пароля',
        );
    }

    /**
     * @see ActiveRecord::attributeNotes()
     */
    public function attributeNotes()
    {
        return array(
            'login' => '6-16 символов. Русские или английские буквы и цыфры.',
            'password' => 'Не меньше 6 символов.',
            'email' => 'Потребуется для активаии аккаунта',
            'verifyCode' => 'Решите уравнение.',
            'img' => '.jpeg максимум 150x150',
            'newPassword' => 'Не меньше 6 символов.',
        );
    }

    /**
     * @see CActiveRecord::relations()
     */
    public function relations()
    {
        return array(
            'rFull' => array(
                self::HAS_ONE,
                'MUserFull',
                'id',
            ),
            'rGroup' => array(
                self::BELONGS_TO,
                'MUserGroup',
                'group',
            ),
        );
    }

    /**
	 * Ищет в БД пользоватея с указанными логином и паролем.
     * Метод валидации.
	 */
	public function authenticate()
    {
        if(!$this->hasErrors())
        {
            $identity = new UserIdentity($this->login, $this->password, $this->saveMe);
            $identity->authenticate();

            switch($identity->errorCode)  {
                case UserIdentity::ERROR_NONE:
                    Yii::app()->user->login($identity, 604800); // 60*60*24*7 = 604800
					break;

                case UserIdentity::ERROR_USERNAME_INVALID:
                    $this->addError('login','Пользователь с указанным логином не зарегистрирован.');
					break;

                case UserIdentity::ERROR_PASSWORD_INVALID:
                    $this->addError('password','Неварно указан пароль.');
					break;

                case UserIdentity::ERROR_IS_CONFIRM_INVALID:
                    $this->addError('login','Пользователь не активирован.');
					break;
            }
        }
    }

    /**
	 * Проверка правильности текущего пароля.
     * Метод валидации.
	 */
	public function checkOldPassword()
	{
		if($this->oldPassword && ($this->password != $this->passwordCript($this->oldPassword)))
			$this->addError('oldPassword', 'Неверно указан текущий пароль.');
	}

    /**
	 * Проверка наличия пользователя с указанными логином и email адресом.
     * Метод валидации.
	 */
	public function checkUserByEmail()
	{
		if(!$this->hasErrors()) {
			if(!$user = MUser::model()->find('t.login = :login AND t.email = :email', array(
				':login' => $this->login,
				':email' => $this->email,
			)))
				$this->addError('login', 'Пользователь с указанной связкой логин-email не найден.');
			else
				$this->id = $user->id;
		}
	}

    /**
     * Возвращает хэш-сумму пароля.
     * @param string $password Пароль
     * @return string хэш-сумма
     */
    public function passwordCript($password)
    {
        return strrev(md5($password));
    }

    /**
     * Возвращает список тем в виде одномерного массива.
     * @return array
     */
    public function getThemesList()
    {
        $list = $this->_themesList;

        while($item = each($list))
            $return[] = $item[0];

        return $return;
    }

    /**
     * Возвращает список тем для Ddl.
     * @return array
     */
    public function getThemesListForDdl()
    {
        return $this->_themesList;
    }

    /**
     * Возвращает тему по умолчанию.
     * @return int
     */
    public function getDefaultTheme()
    {
        return $this->_defaultTheme;
    }

    /**
     * Список тем.
     * @var array
     */
    protected $_themesList = array(
        1 => 'Упрощенная',
    );

    /**
     * Тема по умолчанию.
     * @var int
     */
    protected $_defaultTheme = 1;
}