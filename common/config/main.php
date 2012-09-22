<?php
/**
 * Глобальная конфигурация приложения.
 */
return array(
    'defaultController' => 'index',

    'sourceLanguage' => 'ru',
    'language' => 'ru',

    'preload' => array(
        'log',
    ),

    'import' => array(
        'common.components.*',
        'common.components.baseClasses.*',
        'common.components.global.*',
        'common.components.validators.*',

        'common.models.*',
    ),

    'modules' => array(

    ),

    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning, trace, profile, info',
                    'enabled' => true,
                ),
            ),
        ),

        'user' => array(
            'class' => 'WebUser',
            'loginUrl' => '/user/login',
            'allowAutoLogin' => true,
        ),

        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array(
                'guest',
            ),
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(

            ),
        ),

        'db' => array(
            'class' => 'system.db.CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=<dbName>',
            'username' => '<userName>',
            'password' => '<passeord>',
            'charset' => 'utf8',
            'queryCacheID' => 'system.memCache',
            'schemaCachingDuration' => 3600,
        ),

        'memCache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'dbCache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'fileCache' => array(
            'class' => 'system.caching.CFileCache',
        ),
    ),
);