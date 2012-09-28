<?php
/**
 * Пользователь (сущность).
 */
class EUser extends Essence
{
    /**
     * Id.
     * @var int
     */
    public $id = null;

    /**
     * Cостояние активации пользователя.
     * @var int
     */
    public $isConfirm;

    /**
     * Логин.
     * @var string
     */
    public $login = null;

    /**
     * E-mail.
     * @var email
     */
    public $email = null;

    /**
     * Название группы (роли).
     * @var string
     */
    public $groupName = null;

    /**
     * CSS-стиль группы (роли).
     * @var string
     */
    public $groupStyle = null;

    /**
     * Дата регистрации.
     * @var string
     */
    public $dateReg = null;

    /**
     * Дата последнего посещения.
     * @var string
     */
    public $lastOnline = null;

    /**
     * Полное имя.
     * @var string
     */
    public $name = null;

    /**
     * Пол.
     * @var string
     */
    public $sex = null;

    /**
     * Дата рождения.
     * @var string
     */
    public $birthday = null;

    /**
     * Возвращает id пользователя.
     * @return void
     */
    public function getId()
    {
        echo $this->id;
    }

    /**
     * Отрисовывает аватар пользователя.
     * @return void
     */
    public function getAvatar()
    {
        $this->widget('WUserAvatar', array(
            'id' => $this->id,
        ));
    }

    /**
     * Возвращает логин пользователя.
     * @param bool $isLink Если true, то выводит логин в виде ссылки, иначе в виде такста
     * @param bool $withStyle Если true, то логин оформляется в соответствии со стилем группы
     * @return void
     */
    public function getLogin($isLink = true, $withStyle = true)
    {
        if($isLink === true) {
            $this->widget('WUSerLogin', array(
                'id' => $this->id,
                'login' => $this->login,
                'style' => $this->groupStyle,
            ));
        } else {
            $this->widget('WUSerLogin', array(
                'login' => $this->login,
                'style' => $this->groupStyle,
            ));
        }
    }

    /**
     * Возвращает E-mail пользователя.
     * @return void
     */
    public function getEmail()
    {
        echo $this->email;
    }

    /**
     * Возвращает группу пользователя.
     * @return void
     */
    public function getGroup()
    {
        
    }

    /**
     * Возвращает дату регистрации.
     * @return void
     */
    public function getDateReg()
    {
        echo LDateTime::formatDate($this->dateReg, true);
    }

    /**
     * Возвращает дату последнего посещения.
     * @return void
     */
    public function getLastOnline()
    {
        echo LDateTime::formatDate($this->lastOnline, true);
    }

    /**
     * Возвращает полное имя.
     * @return void
     */
    public function getName()
    {
        if(!empty($this->name))
            echo $this->name;
        else
            echo 'Не указанно';
    }

    /**
     * Возвращает пол.
     * @return void
     */
    public function getSex()
    {
        if(!empty($this->sex))
            echo $this->sex;
        else
            echo 'Не указан';
    }

    /**
     * Возвращает дату рождения.
     * @return void
     */
    public function getBirthday()
    {
        if(!empty($this->birthday))
            echo LDateTime::formatDate($this->birthday);
        else
            echo 'Не указан';
    }

    /**
     * Возвращает состояние активации.
     * @return void
     */
    public function getConfirm()
    {
        if($this->isConfirm == 1)
            echo 'Активирован';
        else
            echo 'Не активирован';
    }

    /**
     * @see Essence::__construct()
     */
    public function __construct($class = __CLASS__)
    {
        parent::__construct($class);
    }
}