<?php
/**
 * Класс роутинга
 */

namespace vendor\core;
use vendor\libs\Helper;

class Router
{
    /**
     * Массив доступных путей
     *
     * @var array
     */
    protected static $routes = [];



    /**
     * Текущий путь
     *
     * @var array
     */
    protected static $route = [];



    /**
     * Добавляет шаблон для роутинга
     *
     * @return void
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }



    /**
     * Возвращает шаблоны для роутинга
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }



    /**
     * Возвращает текущий путь
     *
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }



    /**
     * Приводит строку вида 'class-name' в вид 'ClassName'
     *
     * @param string $str
     *
     * @return string
    */
    protected static function upperCamelCase($str = null)
    {
        $str = str_replace('-', ' ', $str);
        $str = str_replace(' ', '', ucwords($str));

        return $str;
    }



    /**
     * Приводит строку вида 'action-name' в вид 'actionName'
     *
     * @param string $str
     *
     * @return string
     */
    protected static function lowerCamelCase($str = null)
    {
        $str = lcfirst(self::upperCamelCase($str));

        return $str;
    }



    /**
     * Удаляет get параметры
     *
     * @param string $url
     *
     * @return string
     */
    protected static function removeQueryString($url)
    {
        if($url) {
            $params = explode('&', $url, 2);

            if (strpos($params[0], '=') === false)
            {
                return rtrim($params[0], '/');
            }
            else
            {
                return '';
            }
        }
        return($url);
    }



    /**
     * Сопоставляет url с шаблоном
     *
     * @param string $url url
     *
     * @return boolean
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if(preg_match("#$pattern#i", $url, $matchces))
            {
                foreach($matchces as $key => $value)
                {
                    if(is_string($key))
                    {
                        $route[$key] = $value;
                    }
                }

                if(!isset($route['action'])) $route['action'] = 'index';

                $route['controller'] = self::upperCamelCase($route['controller']);

                self::$route = $route;
                return true;
            }
        }
        return false;
    }



    /**
     * Перенаправляет URL по коррекному маршруту
     *
     * @param string входящий в URL
     *
     * @return voin
     */
    public static function dispath($url) {
        $url = self::removeQueryString($url);

        if(self::matchRoute($url))
        {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';

            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';

                if (method_exists($controllerObject, $action))
                {
                    $controllerObject->$action();
                    $controllerObject->getView();
                }
                else
                {
                    throw new \Exception('Метод ' . $controller . '->' . $action . ' не найден', 404);
                }

            }
            else
            {
                throw new \Exception('Контроллер ' . $controller . ' не найден', 404);

            }
        }
        else
        {
            throw new \Exception('Страница не найдена', 404);
        }
    }
}
