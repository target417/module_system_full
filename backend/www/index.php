<?php
// Инициализируем глобальные константы.
const FRONTEND_URL = 'http://moduleSystem.loc/frontend/www';
const BACKEND_URL = 'http://moduleSystem.loc/backend/www';

// Устанавливаем текущую директорию в корень сайта.
chdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

// Подключаем файлы фреймворка и конфигурации.
require_once('common' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'yii-1.1.12' . DIRECTORY_SEPARATOR . 'yii.php');
$backConfig = require_once('backend' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php');
$globalConfig = require_once('common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php');

// Инициализируем алиасы.
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
Yii::setPathOfAlias('root', $root);

Yii::setPathOfAlias('media', $root . DIRECTORY_SEPARATOR . 'media');
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'www');

// Создаем приложение.
require_once('common' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'baseClasses' . DIRECTORY_SEPARATOR . 'WebApplication.php');
$app = Yii::createApplication('WebApplication', CMap::mergeArray($globalConfig, $backConfig));
$app->run();

// Дебаг.
defined('YII_DEBUG') or define('YII_DEBUG', true);