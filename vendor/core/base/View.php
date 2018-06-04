<?php
/**
 * Базовая вид
 *
 */

namespace vendor\core\base;


class View
{
    /**
     * текущий контроллер и параметры
     *
     * @var array
     */
    public $route = [];



    /**
     * текущий вид
     *
     * @var string
     */
    public $view;



    /**
     * Текущий шаблон
     *
     * @var string
     */
    public $layout;



    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if($layout === false)
        {
            $this->layout = false;
        }
        else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }



    /**
     * Выводит данные в шаблон
     *
     * @return resource
     */
    public function render($data = [])
    {
        if(is_array($data)) extract($data);

        $file_view = APP .'/views/' . $this->route['controller'] . '/' . $this->view . '.php';

        ob_start();

        if(is_file($file_view))
        {
            require $file_view;
        }
        else
        {
            throw new \Exception('Не найден вид ' . $file_view);
        }

        $content = ob_get_clean();


        if($this->layout !== false)
        {
            $file_layout = APP . '/views/layouts/' . $this->layout . '.php';
            if(is_file($file_layout))
            {
                require $file_layout;
            }
            else
            {
                throw new \Exception('Не найден шаблон ' . $file_layout);
            }
        }
    }

}