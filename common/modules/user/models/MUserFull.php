<?php
/**
 * Пользователи. Расширеная таблица.
 *
   CREATE TABLE `user_full` (
   `id` INT UNSIGNED NOT NULL ,
   `name` VARCHAR( 25 ) NULL ,
   `sex` ENUM( 'Мужской', 'Женский' ) NULL ,
   `birthday` DATE NULL ,
   `date_reg` DATETIME NOT NULL ,
   PRIMARY KEY ( `id` )
   ) ENGINE = MYISAM ;
 */
class MUserFull extends ActiveRecord
{
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
        return 'user_full';
    }

    /**
     * @see CActiveRecord::rules()
     */
    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 25),
            array('name', 'match', 'pattern' => '/^([а-яa-z0-9 _\-]+)$/i'),

            array('sex', 'in', 'range' => array('Мужской', 'Женский')),

            array('birthday', 'match', 'pattern' => '/^\d\d\.\d\d\.\d\d\d\d$/'),

            array('date_reg', 'default', 'value' => new CDbExpression('NOW()')),
        );
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'sex' => 'Пол',
            'birthday' => 'День рождения',
        );
    }
    /**
     * @see ActiveRecord::attributeNotes()
     */
    public function attributeNotes()
    {
        return array(
            'name' => 'До 25 символов.',
            'sex' => '',
            'birthday' => 'В формате дд.мм.гггг',
        );
    }

    /**
     * @see CActiveRecord::relations()
     */
    public function relations()
    {
        return array(
            'rBase' => array(
                self::HAS_ONE,
                'MUser',
                'di',
            ),
        );
    }
}