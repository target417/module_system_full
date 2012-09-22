<?php
/*
 * Входной контроллер административной части.
 */
final class Indexcontroller extends BackController
{
    /**
     * Входной экшен.
     * @return void
     */
    public function actionIndex()
    {
        echo 'BackEnd is start...';
    }

    /**
     * @see Controller::createPageParams()
     */
    protected function createPageParams()
    {

    }
}