<?php
/**
 * Гостевая книга.
 *
   CREATE TABLE `guestbook` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `author` VARCHAR( 20 ) NOT NULL ,
    `date_create` DATETIME NOT NULL ,
    `text` VARCHAR( 2000 ) NOT NULL ,
    `answer` VARCHAR( 2000 ) NULL ,
    `is_remove` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'
    ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
 */
class MGuestbook extends ActiveRecord
{
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
        return 'guestbook';
    }

    /**
     * @see CActiveRecord::rules()
     */
    public function rules()
    {
        return array(
            array('author', 'length', 'max' => 16),
            array('author', 'match', 'pattern' => '/^([a-z0-9 _\-]+|[а-я0-9 _\-]+)$/iu'),
            array('author', 'default', 'value' => 'Гость'),

            array('date_create', 'default', 'value' => new CDbExpression('NOW()')),

            array('text, answer', 'length', 'min' => 10, 'max' => 2000),

            array('is_remove', 'default', 'value' => 0),

            // Добавление нового сообщения.
            array('text, verifyCode', 'required', 'on' => 'addMessage'),
			array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'addMessage'),
        );
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'author' => 'Автор',
            'text' => 'Текст сообщения',
            'answer' => 'Текст ответа',
            'is_remove' => 'Комментарий удален',
            'verifyCode' => 'код проверки',
        );
    }

    /**
     * @see ActiveRecord::attributeNotes()
     */
    public function attributeNotes()
    {
        return array(
            'author' => '6-16 символов. Русские или английские буквы и цыфры.',
            'verifyCode' => 'Решите уравнение.',
            'text' => '10 - 2000 символов.',
            'answer' => '10 - 2000 символов.',
        );
    }
}