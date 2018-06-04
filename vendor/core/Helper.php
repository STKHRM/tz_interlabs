<?php
/**
 * Класс с помощниками
 */

namespace vendor\libs;

class Helper
{


    /**
     * Печатает переменную
     *
     * @param $var переменная для печати
     * @param string $label подпись
     * @param boolean $stop остановить скрипт после печати или нет
     *
     * @return void
     */
    public static function debug($var, $label = null, $stop = false)
    {
        if(!empty($label)) print '<b>' . $label . '</b><br>';
        if(!empty($var))
        {
            print '<pre>';
            print_r($var);
            print '</pre>';
        }
        else
        {
            print '<pre>DEBUG: пустое значение</pre>';
        }

        if($stop) die();
    }
}
