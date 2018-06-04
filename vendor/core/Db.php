<?php
/**
 * Класс для работы с базой данных
 */

namespace vendor\core;
use vendor\libs\Helper;

class Db
{
    /**
     * PDO
     *
     * @var object
     */
    protected $pdo;



    /**
     * Самообъект
     *
     * @var object
     */
    protected static $instance;



    /**
     * Массив истории SQL завпросов
     *
     * @var array
     */
    public static $queries = [];



    /**
     * Конструктор
     *
     * @var void
     */
    protected function  __construct()
    {
        $db = require ROOT .'/config/config_db.php';

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
        $this->pdo->exec('set names utf8');
    }



    /**
     * Самовызов. Возвращает экземпляр себя, при необходимости создает
     *
     * @var object
     */
    public static function instance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }



    /**
     * Выполняет SQL запрос
     *
     * @var object
     */
    public function execute($sql, $params = [])
    {
        self::$queries[] = $sql;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute($params);
    }



    /**
     * Выполняет SQL запрос
     *
     * @var array
     */
    public function query($sql, $params = [])
    {
        self::$queries[] = $sql;
        $statement = $this->pdo->prepare($sql);
        $res = $statement->execute($params);

        if($res !== false)
        {
            return $statement->fetchAll();
        }
        else
        {
            return [];
        }
    }



    /**
     * Возвращает все записи
     *
     * @var array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        return $this->pdo->query($sql);
    }
}