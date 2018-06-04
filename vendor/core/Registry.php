<?php
/**
 * Класс регистр
 */

namespace vendor\core;


class Registry
{

    /**
     * Массив доступных объектов
     *
     * @var array
     */
    public static $objects = [];



    /**
     * Самообъект
     *
     * @var object
     */
    protected static $instance;



    /**
     * Конструктор
     *
     * @var void
     */
    protected function __construct()
    {
        $config  = require ROOT .'/config/config_app.php';
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }



    /**
     * Самовызов
     *
     * @var object
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }



    /**
     * Магический метод для вызова доступного объекта
     *
     * @var object
     */
    public function __get($name)
    {
        if(is_object(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
    }



    /**
     * Магический метод для добавления объекта
     *
     * @var void
     */
    public function __set($name, $object)
    {
        if(!isset(self::$objects[$name]))
        {
            self::$objects[$name] = new $object;
        }
    }

}