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

        // Если пользователь - гость, перенаправляет на страницу авторизации.
       if(Yii::app()->user->isGuest) {
           if($this->id != 'index' || $action->id != 'login')
               $this->redirect(Yii::app()->user->loginUrl);
       // Если пользователь авторизирован, но недостаточно прав для доступа к CMS,
       // генерирует исключение и выбрасывает пользователя из системы.
       } else {
           if(!Yii::app()->user->checkAccess('access_cms')) {
                Yii::app()->user->logout();
                throw new CHttpException(404, self::EXC_NO_ACCESS);
           }
       }

        return true;
    }
}
