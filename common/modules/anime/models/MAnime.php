<?php
/**
 * Аниме-релиз.
 *
   CREATE TABLE `anime` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `headline` VARCHAR( 250 ) NOT NULL ,
   `url` VARCHAR( 250 ) NOT NULL ,
   `author` INT UNSIGNED NOT NULL ,
   `date_create` DATETIME NOT NULL ,
   `section` TINYINT UNSIGNED NOT NULL ,
   `full_name` VARCHAR( 2000 ) NOT NULL ,
   `year` INT( 4 ) UNSIGNED NOT NULL ,
   `type` VARCHAR( 250 ) NOT NULL ,
   `edition_begin` DATE NOT NULL ,
   `edition_end` DATE NULL ,
   `edition_details` VARCHAR( 250 ) NOT NULL ,
   `description` VARCHAR( 10000 ) NOT NULL ,
   `tracker_info` VARCHAR( 2000 ) NULL ,
   `dub_lang` TINYINT UNSIGNED NOT NULL ,
   `dub_author` VARCHAR( 100 ) NULL ,
   `subs_lang` TINYINT UNSIGNED NULL ,
   `subs_author` VARCHAR( 100 ) NULL
   ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
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
            array('headline', 'length', 'max' => 250),
            array('headline', 'match', 'pattern' =>'/^[a-zа-я0-9\-_ \[\]\(\)\.\,]+$/is'),

            array('date_create', 'default', 'value' => new CDbExpression('NOW()')),

            array('author', 'default', 'value' => Yii::app()->user->id),

            array('section', 'numerical'),

            array('year', 'match', 'pattern' => '/^\d\d\d\d&/'),

            array('type', 'length', 'max' => 250),
            array('type', 'match', 'pattern' => '/^[a-zа-я0-9\-_ \[\]\(\)\.\,]+$/is'),

            array('edition_begin, edition_end', 'match', 'pattern' => '/^\d\d\d\d-\d\d-\d\d$/'),

            array('edition_details', 'length', 'max' => 250),
            array('edition_details', 'match', 'pattern' => '/^[a-zа-я0-9\-_ \[\]\(\)\.\,]+$/is'),

            array('full_name', 'length', 'max' => 2000),

            array('description', 'length', 'max' => 10000),

            array('tracker_info', 'length', 'max' => 2000),

            array('dub_lang, subs_lang', 'numerical'),

            array('dub_author, subs_author', 'length', 'max' => 100),

            // Добавление нвоого аниме.
            array('headline, description, section', 'required', 'on' => 'add'),
        );
    }

    /**
     * @see ActiveRecord::attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'headline' => 'Заголовок',
            'section' => 'Раздел',
            'type' => 'Тип релиза',
            'edition_begin' => 'Трансляция (начало)',
            'edition_end' => 'Трансляция (конец)',
            'edition_details' => 'Трансляция (детали)',
            'full_name' => 'Название (вариянты)',
            'description' => 'Описание',
            'tracker_info' => 'информация о трекере',
            'subs_lang' => 'Субтитры (язык)',
            'subs_author' => 'Субтитры (автор)',
            'dub_lang' => 'Озвучка (язык)',
            'dub_author' => 'Озвучка (автор)',
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
        return array(
            'rAuthor' => array(
                self::BELONGS_TO,
                'MUser',
                'author',
            ),
        );
    }

    /**
     * Возвращает список языков озвучки.
     * @return array
     */
    public static function getDubLangsList()
    {
        return MAnime::$_dubLangsList;
    }

    /**
     * Возвращает список языков озвучки для выпадающего списка.
     * @return array
     */
    public static function getDubLangsListForDdl()
    {
        $list = MAnime::getDubLangsList();

        foreach($list AS $item) {
            $return[$item['id']] = $item['ruName'];
        }

        return $return;
    }

    /**
     * Возвращает список языков субтитров.
     * @return array
     */
    public static function getSubsLangsList()
    {
        return MAnime::$_subsLangsList;
    }

    /**
     * Возвращает список языков субтитров для выпадающего списка.
     * @return array
     */
    public static function getSubsLangsListForDdl()
    {
        $list = MAnime::getSubsLangsList();

        foreach($list AS $item) {
            $return[$item['id']] = $item['ruName'];
        }

        return $return;
    }

    /**
     * Список языков озвучки.
     * @var array
     */
    protected static $_dubLangsList = array(
        1 => array('id' => 1, 'ruName' => 'Русский', 'enName' => 'ru'),
        2 => array('id' => 2, 'ruName' => 'Японский', 'enName' => 'jp'),
    );

    /**
     * Список язвков субтитров.
     * @var array
     */
    protected static $_subsLangsList = array(
        1 => array('id' => 1, 'ruName' => 'Русский', 'enName' => 'ru'),
    );
}