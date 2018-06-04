<?php
/**
 * Класс для работы с запросами
 */


namespace vendor\core;

class Request
{
    /**
     * Производит редирект
     *
     * @param string $url url страницы на которую производится редирект
     *
     * @return resource
     */
    public function redirect($url = null)
    {
        if(!empty($url))
        {
            $redirect = $url;
        }
        else
        {
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        }

        header("Location:$redirect");
        die();
    }
}