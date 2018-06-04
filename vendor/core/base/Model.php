<?php
/**
 * Базовая модель
 *
 */

namespace vendor\core\base;
use vendor\core\Db;
use vendor\libs\Helper;

abstract class Model
{
    /**
     * PDO
     *
     * @var object
     */
    protected $pdo;



    /**
     * Таблица
     *
     * @var string
     */
    protected $table;



    /**
     * Поле в таблице по умолчанию
     *
     * @var string
     */
    protected $primaryKey = 'id';



    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeConstruct();
        $this->pdo = Db::instance();
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
     * Возвращает название таблицы
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->table;
    }



    /**
     * Выполняет SQL запрос
     *
     * @return array
     */
    public function query($sql, $params = [])
    {
        return $this->pdo->execute($sql, $params = []);
    }



    /**
     * Возвращает все строки таблицы
     *
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;

        return $this->pdo->query($sql);
    }



    /**
     * Возвращает одну строку таблицы
     *
     * @return array
     */
    public function findOne($value, $field = '')
    {
        $field = $field ?: $this->primaryKey;
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = ? LIMIT 1';
        $result = $this->pdo->query($sql, [$value]);

        if(!empty($result[0])) $result = $result[0];

        return $result;
    }



    /**
     * Выполняет переданный SQL запрос и возвращает массив полученных данных
     *
     * @return array
     */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }



    /**
     * Возвращает количество найденых строк
     *
     * @return integer
     */
    public function count($value = '', $field = '')
    {
        $field = $field ?: $this->primaryKey;
        if(!empty($value))
        {
            $sql = 'SELECT count(*) FROM ' . $this->table . ' WHERE ' . $field . ' = ?';
            $result = $this->pdo->query($sql, [$value]);
        }
        else
        {
            $sql = 'SELECT count(*) FROM ' . $this->table;
            $result = $this->pdo->query($sql);
        }


        if(!empty($result[0]['count(*)']))
        {
            $result = $result[0]['count(*)'];
        }
        else {
            $result = 0;
        }

        return $result;
    }



    /**
     * Обновляет записи
     *
     * @return boolean
     */
    public function update($data, $field = '')
    {
        $field = $field ?: $this->primaryKey;

        foreach ($data as $id => $fields)
        {
            $updateData = [];
            $params = [];
            $result = true;

            foreach ($fields as $name => $value)
            {
                $updateData[] = '`'.$name.'`' . ' = ?';
                $params[] = $value;
            }

            $params[] = $id;

            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $updateData) . ' WHERE `' . $field . '` = ?';

            if(!$this->pdo->execute($sql, $params)) $result = false;

        }
        return $result;
    }



    /**
     * Добавляет записи
     *
     * @return boolean
     */
    public function insert($data)
    {
        foreach ($data as $id => $fields)
        {
            $insertData = [];
            $params = [];
            $result = true;

            foreach ($fields as $name => $value)
            {
                $insertData[] = '`'.$name.'`' . ' = ?';
                $params[] = $value;
            }

            $sql = 'INSERT INTO ' . $this->table . ' SET ' . implode(', ', $insertData);

            if(!$this->pdo->execute($sql, $params)) $result = false;

        }
        return $result;
    }



    /**
     * Удаляет записи
     *
     * @return boolean
     */
    public function delete($data, $field = '')
    {
        $field = $field ?: $this->primaryKey;

        foreach ($data as $key => $id)
        {
            $params = [];
            $result = true;

            $params[] = $id;

            $sql = 'DELETE FROM ' . $this->table . ' WHERE `' . $field . '` = ?';

            if(!$this->pdo->execute($sql, $params)) $result = false;

        }
        return $result;
    }
}