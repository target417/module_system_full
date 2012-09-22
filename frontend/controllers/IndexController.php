<?php
/*
 * Входной контроллер пользовательской части.
 */
final class Indexcontroller extends FrontController
{
    /**
     * Входной экшен.
     * @return void
     */
    public function actionIndex()
    {
        echo 'FrontEnd is start...';
    }

    /**
     * @see Controller::createPageParams()
     */
    protected function createPageParams()
    {

    }
}