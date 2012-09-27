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
     * Группы (роли).
     * @var array
     */
    public $group = null;

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

    }

    /**
     * Возвращает логин пользователя.
     * @param bool $isLink Если true, то выводит логин в виде ссылки, иначе в виде такста
     * @return void
     */
    public function getLogin($isLink = true)
    {
        if($isLink === true) {
            $this->widget('WUSerLogin', array(
                'id' => $this->id,
                'login' => $this->login,
                'style' => $this->group['style'],
            ));
        } else {
            $this->widget('WUSerLogin', array(
                'login' => $this->login,
                'style' => $this->group['style'],
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
        $this->widget(WUsergroup, array(
            'group' => $this->group['group'],
            'style' => $this->group['style']
        ));
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