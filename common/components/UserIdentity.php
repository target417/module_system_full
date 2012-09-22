<?php
/**
 * Идентификация пользователя.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * @see CUserIdentity::__construct()
     */
    public function __construct($username, $password, $saveMe)
    {
        parent::__construct($username, $password);
        $this->_saveMe = $saveMe;
    }

    /**
     * @see CuserIdentity::authenticate()
     */
    public function authenticate()
    {
        $record = MUser::model()->findByAttributes(array(
            'login' => $this->username,
            'is_remove' => 0,
            'is_activate' => 1,
            ));

        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->password !== $record->passwordCript($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $record->id;

            $this->setState('id', $record->id);
            $this->setState('theme', $record->theme);
            $this->setState('login', $record->login);
            $this->setState('theme', $record->getThemeInfoById($record->theme, 'enName'));

            // Генерируем соль для входа по cookies, если отмеченно "запомнить меня".
            if ($this->_saveMe == 1) {
                $solt = LNumber::generateNumber();
                $this->setState('cookiesSolt', $solt);

                $record->cookies_solt = $solt;
                $record->save(false);
            }

            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    /**
     * @see CUserIdentity::getId()
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Id пользователя.
     * @var int
     */
    protected $_id;

    /**
     * Поле "запомнить меня".
     * @var int
     */
    protected $_saveMe;

}