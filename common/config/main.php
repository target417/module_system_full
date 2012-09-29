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
        'common.modules.user.models.*',
    ),

    'modules' => array(
        'user',
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
            'connectionString' => 'mysql:host=localhost;dbname=module_system',
            'username' => 'module_system',
            'password' => 'password',
            'charset' => 'utf8',
//            'queryCacheID' => 'system.memCache',
//            'schemaCachingDuration' => 0,
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