<?php
/**
 * Класс приложения
 */

namespace vendor\core;
use vendor\core\Registry;


class App
{
    /**
     * Приложение
     *
     * @var object
     */
    public static $app;



    /**
     * Конструктор
     *
     * @return object
     */
    public function __construct()
    {
        self::$app = Registry::instance();
        new ErrorHandler();
        session_start();
    }

}