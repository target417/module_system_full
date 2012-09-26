<?php
/**
 * Базовый класс сущностей.
 * Унаследован от CController для поддержания виджетов.
 */
abstract class Essence extends CController
{
    /**
     * @see CController::__construct()
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}