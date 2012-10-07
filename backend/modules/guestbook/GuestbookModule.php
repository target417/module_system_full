<?php
/**
 * Модуль гостевой книги.
 *
 * @author пикаев Виктор <target417@gmail.com>
 * @version 1.0 beta
 */
class GuestbookModule extends WebModule
{
	public function init()
	{
		$this->setImport(array(
			'common.modules.guestbook.components.*',
			'common.modules.guestbook.components.widgets.*',

			'common.modules.guestbook.models.*',
		));

        // Инициализация переменных.
        $this->setParams(array(
            // Колличество сообщений на странице.
            'messagesOnPage' => 25,

            // время кэширования.
            'cacheTime' => array(

            ),
        ));
    }
}
