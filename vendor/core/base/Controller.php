<?php
/**
 * Базовый контроллер
 */


namespace vendor\core\base;


abstract class Controller
{
    /**
     * Текущий контроллер и параметры
     *
     * @var array
     */
    public $route = [];



    /**
     * Текущий вид
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
     * Данные для вывода в шаблоне
     *
     * @var array
     */
    public $data = [];



    /**
     * Конструктор
     *
     * @param array $route
     *
     * @return void
     */
    public function __construct($route)
    {
        $this->beforeConstruct();
        $this->route = $route;
        $this->view = $route['action'];
        $this->afterConstruct();
    }



    /**
     * Обработчик который запускается до вызова всех функций в конструкторе
     *
     * @return void
     */
    public function beforeConstruct()
    {

    }



    /**
     * Обработчик который запускается после вызова всех функций в конструкторе
     *
     * @return void
     */
    public function afterConstruct()
    {

    }



    /**
     * Возвращает текущий вид
     *
     * @return resource
     */
    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view);
        $viewObject->render($this->data);
    }



    /**
     * Устанавливает данные для вывода в шаблоне
     *
     * @return void
     */
    public function setViewData($data = [])
    {
        $this->data = $data;
    }



    /**
     * Проверят тип запроса к странице
     *
     * @return boolean
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }



    /**
     * Возвращает вид текущего контроллера
     *
     * @return resource
     */
    public function renderView($view, $data = [])
    {
        extract($data);
        $file_view =  APP .'/views/' . $this->route['controller'] . '/' . $view . '.php';

        if(is_file($file_view))
        {
            require $file_view;
        }
        else
        {
            throw new \Exception('Не найден вид ' . $file_view);
        }
    }
}