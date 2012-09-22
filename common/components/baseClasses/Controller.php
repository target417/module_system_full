<?php
/**
 * Базовый класс контроллера.
 */
abstract class Controller extends CController
{

    const EXCEPTION_NO_ACCESS = 'Не достаточно прав для выполнения сценария';
    const EXCEPTION_WRONG_ADDRESS = 'Неверно указан адрес страницы';

    /**
     * Формирование индивидуальных параметров страницы:
     * Формирование метатегов, подключение js- и css- файлов.
     * @return bolean True в сучае успеха, иначе - false
     * @abstract
     */
    abstract protected function createPageParams();

    /**
     * Динамичные экшены.
     * @return array
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'MathCaptcha',
            ),
        );
    }

    /**
     * Мета-тэг Title.
     * @var string
     */
    protected $_pageTitle;

    /**
     * Мета-тэг Description.
     * @var string
     */
    protected $_pageDescription;

    /**
     * Мета-тэг KeyWords.
     * @var string
     */
    protected $_pageKeyWords;

    /**
     * Вторичная конфигурация.
     * @var array
     */
    protected $_config;

    /**
     * Ajax валидация форм.
     * @param object $model Модель, которую надо проверить
     * @return void
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax'])) {
            echo ActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Валидация сразу нескольких моделей.
     * @param array of Model or ActiveRecord $models Массив с моделями
     * @return boolean True если все модели прошли валидацию, иначе fasle
     */
    protected function multipleValidate(array $models)
    {
        $errors = true;

        while($model  = each($models)) {
            if(!$model->validate())
                $errors = false;
        }

        return $errors;
    }
}