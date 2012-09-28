<?php
/**
 * Конфигурация пользовательскй части.
 */
return array(
    'basePath' => 'backend',

	'import' => array(
		'backend.components.*',
		'backend.models.*',
	),

    'components' => array(
        'user' => array(
            'loginUrl' => '/backend/www/index/login',
        ),
    ),
);