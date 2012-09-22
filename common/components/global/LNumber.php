<?php
/**
 * Библиотека функций работы с числами.
 * Входит в состав Библиотеки глобальных функций.
 * @auhot Пикаев Вкитор <target417@gmail.com>
 * @since 1.0
 */
class LNumber
{
	/**
	 * Случайное число для указанного типа переменных.
	 * @param strins $type Тип переменной (максимальная длинна числа)
	 * @return int Сгенрированное число
	 */
	static public function generateNumber($type = 'int')
	{
		switch($type) {
			case 'tinyint' :
				$maxValue = 127;
				break;

			case 'mediumint' :
				$maxValue = 8388607;
				break;

			case 'int' :
				$maxValue = 2147483647;
				break;

			case 'bigint' :
				$maxValue = 9223372036854775807;
				break;
		}

		return rand(0, $maxValue);
	}
}