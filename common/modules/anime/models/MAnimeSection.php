<?php
/**
 * разделы аниме-релизов.
 */
class MAnimeSection extends Model
{
    /**
     * Фозвращает класс модели.
     * Класс инициализируется лиш однажды.
     * @static
     * @return object
     */
    public static function model()
    {
        if(!isset(MAnimeSection::$_model))
            MAnimeSection::$_model = new MAnimeSection();

        return MAnimeSection::$_model;
    }

    /**
     * Возвращает список разделов.
     * @return array
     */
    public function getList()
    {
        return $this->_list;
    }

    /**
     * Список разделов аниме.
     * Разделы хранятся в виде двухуровневого ассоциативного массива.
     * Первый уровень - разделы-контейнеры, которые не могут содержать в себе релизов.
     * Второй уровень - разделы, содержащие в себе релизы.
     * @var array
     */
    protected $_list = array(
        1 =>array('id' => 1, 'name' => 'Аниме с озвучкой', url => 'anime-rus', 'parent' => 0),
        11 =>array('id' => 11, 'name' => 'ТВ-сериалы', url => 'tv-rus', 'parent' => 1),
        12 =>array('id' => 12, 'name' => 'Фильмы', url => 'film-rus', 'parent' => 1),
        13 =>array('id' => 13, 'name' => 'OVA', url => 'ova-rus', 'parent' => 1),
        14 =>array('id' => 14, 'name' => 'онгоинги', url => 'obgoing-rus', 'parent' => 1),

        2 =>array('id' => 2, 'name' => 'Аниме с субтитрами', url => 'anime-sub', 'parent' => 0),
        21 =>array('id' => 11, 'name' => 'ТВ-сериалы', url => 'tv-sub', 'parent' => 2),
        22 =>array('id' => 12, 'name' => 'Фильмы', url => 'film-sub', 'parent' => 2),
        23 =>array('id' => 13, 'name' => 'OVA', url => 'ova-sub', 'parent' => 2),
        24 =>array('id' => 14, 'name' => 'онгоинги', url => 'obgoing-sub', 'parent' => 2),
    );

    /**
     * экземпляр класса.
     * @var object
     */
    private static $_model;
}