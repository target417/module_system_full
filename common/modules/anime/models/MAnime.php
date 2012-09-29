<?php
/**
 * Аниме-релиз.
 */
class MAnime extends ActiveRecord
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
        return 'anime';
    }

    /**
     * @see CActiveRecord::rules()
     */
    public function rules()
    {
        return array(

        );
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return array(

        );
    }

    /**
     * @see ActiveRecord::attributeNotes()
     */
    public function attributeNotes()
    {
        return array(

        );
    }

    /**
     * @see CActiveRecord::relations()
     */
    public function relations()
    {
      
    }
}