<?php
/**
 * Пользователи. Основная таблица.
 *
   CREATE TABLE `user` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `login` VARCHAR( 20 ) NOT NULL ,
   `password` VARCHAR( 32 ) NOT NULL ,
   `theme` TINYINT UNSIGNED NULL ,
   `cookie_solt` INT UNSIGNED NOT NULL ,
   `is_confirm` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
   `is_remove` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'
   ) ENGINE = MYISAM ;
 */
final class MUser extends ActiveRecord
{
    /**
     * Поле "запомнить меня".
     * @var bool
     */
    public $saveMe;

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
            array('login', 'match', 'pattern' => '/^([a-z0-9 _\-]+|[а-я0-9 _\-]+)$/i'),

            array('password', 'length', 'min' => 6),

            array('is_confirm, is_remove', 'default', 'value' => 0),

            array('theme', 'numerical'),
            array('theme', 'default', 'value' => $this->getDefaultTheme()),
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
            'theme' => 'Тема оформления',
            'is_confirm' => 'Активирован',
            'is_remove' => 'Удален',
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
        );
    }

    /**
     * @see CActiveRecord::relations()
     */
    public function relations()
    {
        return array(

        );
    }

    /**
     * Тема по умолчанию.
     * @var int
     */
    private $_defaultTheme = 1;

    /**
     * Возвращает тему по умолчанию.
     * @return int
     */
    private function getDefaultTheme()
    {
        return $this->_defaultTheme;
    }
}