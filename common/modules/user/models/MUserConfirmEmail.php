<?php
/**
 * Список подтверждаемых email.
 *
   CREATE TABLE `user_confirm_email` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `user` INT UNSIGNED NOT NULL ,
   `email` VARCHAR( 100 ) NOT NULL ,
   `solt` INT UNSIGNED NOT NULL
   ) ENGINE = MYISAM ;
 */
class MUserConfirmEmail extends ActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_confirm_email';
    }

	public function attributeNotes()
	{
		return array(

		);
	}
}