<?php
$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('DEBUG', true); // Показывать ошибки
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', dirname(__DIR__) . '/vendor/core');
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');

require_once CORE . '/Helper.php';

// Автозагрузка
spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';

    if(is_file($file))
    {
        require_once($file);
    }
});

new vendor\core\App();
// Роутинг
vendor\core\Router::add('^$', [
    'controller' => 'Data',
    'action' => 'index'
]);

vendor\core\Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

vendor\core\Router::dispath($query);
