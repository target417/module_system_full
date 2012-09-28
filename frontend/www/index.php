<?php
// Устанавливаем текущую директорию в корень сайта.
chdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

// Подключаем файлы фреймворка и конфигурации.
require_once('common' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'yii-1.1.12' . DIRECTORY_SEPARATOR . 'yii.php');
$frontConfig = require_once('frontend' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php');
$globalConfig = require_once('common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php');

// Инициализируем алиасы.
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('media', $root . DIRECTORY_SEPARATOR . 'media');
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'www');

// Создаем приложение.
$app = Yii::createApplication('CWebApplication', CMap::mergeArray($globalConfig, $frontConfig));
$app->run();

// Дебаг.
defined('YII_DEBUG') or define('YII_DEBUG', true);