<?php
/**
 * Модуль пользовательского функционала.
 *
 * @author пикаев Виктор <target417@gmail.com>
 * @version 2.0
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
            // Место расположения аватаров пользователей.
            'avatarsDir' => Yii::getPathOfAlias('media') . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . 'avatars',
            'avatarsDirHtml' => '/media/user/avatars',

            'defaultAvatar' => Yii::getPathOfAlias('media') . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . 'default.png',
            'defaultAvatarHtml' => '/media/user/avatars/default.png',

            // время кэширования.
            'cacheTime' => array(
                
            ),
        ));
    }
}
