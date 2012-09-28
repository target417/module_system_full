<?php
/**
 * Базовый контроллер пользовательской части.
 */
abstract class FrontController extends Controller
{
    /**
     * @see CController::beforeAction()
     */
    protected function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;

        $this->createPageParams();

        return true;
    }
}
