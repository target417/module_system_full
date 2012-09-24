<?php
/**
 * Пользователь (сущность).
 */
class SUser
{
    /**
     * Id.
     * @var int
     */
    public $id;

    /**
     * Логин.
     * @var string
     */
    public $login;

    /**
     * E-mail.
     * @var email
     */
    public $email;

    /**
     * Группы (роли).
     * @var array
     */
    public $groups;

    /**
     * Дата регистрации.
     * @var string
     */
    public $dateReg;

    /**
     * Дата последнего посещения.
     * @var string
     */
    public $lastOnline;

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

    }

    /**
     * Возвращает логин пользователя.
     * @return void
     */
    public function getLogin()
    {

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
     * Возвращает список групп (ролей) пользователя.
     * @return void
     */
    public function getGroups()
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
        if(isset($this->name))
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
        if(isset($this->sex))
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
        if(isset($this->berthday))
            echo LDateTime::formatDate($this->birthday);
        else
            echo 'Не указан';
    }
}