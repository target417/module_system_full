<?php
/**
 * Дата последнего посещения сайта пользоателем.
 *
   CREATE TABLE `user_last_online` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `user` INT UNSIGNED NOT NULL ,
   `last_online` datetim NOT NULL ,
   ) ENGINE = MYISAM ;
 */
class MUserLastOnline extends ActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_last_online';
    }

	public function attributeNotes()
	{
		return array(

		);
	}
}