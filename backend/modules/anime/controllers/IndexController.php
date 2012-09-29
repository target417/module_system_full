<?php
/*
 * Входной контроллер модуля.
 */
class IndexController extends BackController
{
    /**
     * Главная страница модуля.
     * Предоставляет список релизов. добавленных пользователем.
     * @return void
     */
    public function actionIndex()
    {
      
    }

    /**
     * @see Conctroller::createPageParams()
     */
    protected function createPageParams()
    {
        switch($this->action->id) {
            case 'index' :
                if(!Yii::app()->user->checkAccess('anime_access_cms'))
                    throw new CHttpException(404, self::EXC_NO_ACCESS);
                break;
        }
    }
}
