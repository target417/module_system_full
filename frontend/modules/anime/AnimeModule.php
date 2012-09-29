<?php
/**
 * Модуль аниме-релизов.
 * Предоставляет информацию о фильмах, и онлайн просмотр.
 *
 * @author пикаев Виктор <target417@gmail.com>
 * @version 1.0
 */
class AnimeModule extends WebModule
{
	public function init()
	{
		$this->setImport(array(
			'common.modules.anime.components.*',
			'common.modules.anime.components.widgets.*',

			'common.modules.anime.models.*',
		));

        // Инициализация переменных.
        $this->setParams(array(
            // время кэширования.
            'cacheTime' => array(
                
            ),
        ));
    }
}