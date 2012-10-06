<?php
/**
 * Библиотека функций этапа разработки.
 * Входит в состав Библиотеки глобальных функций.
 * @auhot Пикаев Вкитор <target417@gmail.com>
 * @since 1.0
 */
class LDevelop
{
    /**
     * Выводит отформатированный результат функции print_r() .
     * @param mixed $param Параметр передаваемый в функцию print_r()
     * @retunr void
     */
    public static function printR($param)
    {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }
}