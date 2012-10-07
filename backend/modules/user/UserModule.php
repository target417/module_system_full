<?php
/**
 * Модуль пользовательского функционала.
 *
 * @author пикаев Виктор <target417@gmail.com>
 * @version 1.0 beta
 */
class UserModule extends WebModule
{
	public function init()
	{
		$this->setImport(array(
			'common.modules.user.components.*',
			'common.modules.user.components.widgets.*',

			'common.modules.user.models.*',
		));

        // Инициализация переменных.
        $this->setParams(array(
            // Колличество пользователей на странице.
            'usersOnPage' => 25,

            // время кэширования.
            'cacheTime' => array(

            ),
        ));
    }
}
