<?php
/**
 * Базовый контроллер административной части.
 */
abstract class BackController extends Controller
{
    /**
     * @see CController::beforeAction()
     */
    protected function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;

        // Перенаправляет неавторизированных пользователей на страницу авторизации.
        // Если пользователь авторизирован, проверяем наличие прав для доступа к CSM.
        if(Yii::app()->user->isGuest && ($this->id != 'index' || $action->id != 'login')) {
            $this->redirect(Yii::app()->user->loginUrl);
        } else {
            if(!Yii::app()->user->checkAccess('access_cms'))
                throw new CHttpException(404, self::EXC_NO_ACCESS);
        }

        return true;
    }
}
