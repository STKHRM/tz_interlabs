<?php
/**
 * Пагинация
 */

namespace vendor\core\libs;
use vendor\libs\Helper;

class Pagination
{
    /**
     * Общее количество записей
     *
     * @var string
     */
    public $total;



    /**
     * Количество записей на одну страницу
     *
     * @var integer
     */
    public $perpage;



    /**
     * Общее количество страниц
     *
     * @var string
     */
    public $countPages;



    /**
     * Текущая страница
     *
     * @var string
     */
    public $currentPage;



    /**
     * url
     *
     * @var string
     */
    public $url;



    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct($page, $perpage, $total)
    {
        $this->total = $total;
        $this->perpage = $perpage;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->url = $this->getParams();
    }



    /**
     * Возвращает количество страниц
     *
     * @return integer
     */
    public function getCountPages()
    {
        return ceil($this->total / $this->perpage ?: 1);
    }



    /**
     * Возвращает текущую страницу
     *
     * @param integer $page Текущая страница
     *
     * @return integer
     */
    public function getCurrentPage($page)
    {
        if(!$page || $page < 1) $page = 1;
        if($page > $this->countPages) $page = $this->countPages;

        return $page;
    }



    /**
     * Возвращает начальную страницу
     *
     * @return integer
     */
    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }



    /**
     * Разбивает угл на параметры и возвращает текущий url
     *
     * @return string
     */
    public function getParams()
    {
        $url = htmlspecialchars($_SERVER['REQUEST_URI']);
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if(isset($url[1]) && $url[1] != '')
        {
            $params = explode('&', $url[1]);
            foreach ($params as $param)
            {
                if(!preg_match('#page=#', $param)) $uri .= $param . '&amp;';
            }
        }

        return $uri;
    }



    /**
     * Возвращает массив данных для вывода в шаблон
     *
     * @return array
     */
    public function getItems()
    {
        $items = [
            'url' => $this->url,
            'backward' => null,
            'forward' => null,
            'first' => null,
            'last' => null,
            'prev' => null,
            'next' => null,
            'current' => $this->currentPage,

            'url' => $this->url,
            'backward' => [
                'text' => '&lt;',
                'value' => null,
            ],
            'forward' => [
                'text' => '&gt;',
                'value' => null,
            ],
            'first' => [
                'text' => '&laquo;',
                'value' => null,
            ],
            'last' => [
                'text' => '&raquo;',
                'value' => null,
            ],
            'prev' => [
                'text' => $this->currentPage - 1,
                'value' => null,
            ],
            'next' => [
                'text' => $this->currentPage + 1,
                'value' => null,
            ],
            'current' => [
                'text' => $this->currentPage,
                'value' => null,
            ]
        ];

        if($this->currentPage > 1)
        {
            $items['backward']['value'] = 'page=' . ($this->currentPage - 1);
        }

        if($this->currentPage < $this->countPages)
        {
            $items['forward']['value'] = 'page=' . ($this->currentPage + 1);
        }

        if($this->currentPage > 2)
        {
            $items['first']['value'] = 'page=1';
        }

        if($this->currentPage < ($this->countPages - 1))
        {
            $items['last']['value'] = 'page=' . $this->countPages;
        }

        if($this->currentPage - 1 > 0)
        {
            $items['prev']['value'] = 'page=' . ($this->currentPage - 1);
        }

        if($this->currentPage + 1 <= $this->countPages)
        {
            $items['next']['value'] = 'page=' . ($this->currentPage + 1);
        }

        return $items;
    }


}