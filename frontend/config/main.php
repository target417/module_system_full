<?php
/**
 * Конфигурация пользовательскй части.
 */
return array(
    'basePath' => 'frontend',

	'import' => array(
		'frontend.components.*',
		'frontend.models.*',
	),

    'components' => array(
        'user' => array(
            'loginUrl' => '/frontend/www/user/index/login',
        ),
    ),
);