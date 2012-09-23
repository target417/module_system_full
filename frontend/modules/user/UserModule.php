<?php
/**
 * Модуль пользовательского функционала.
 *
 * @author пикаев Виктор <target417@gmail.com>
 * @version 2.0
 */
class UserModule extends WebModule
{
    /**
     * Время кэширования.
     * @var array
     */
    public $cacheTime = array(
        'profile' => 600, // 10 мин.
    );

	public function init()
	{
		$this->setImport(array(
			'common.modules.user.components.*',

			'common.modules.user.models.*',
		));
	}
}
