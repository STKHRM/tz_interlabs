<?php
/**
 * Модель для работы с данными (списком пользователей)
 *
 * Выполняет обработку данных
 *
 */

namespace app\models;
use vendor\core\base\Model;
use vendor\core\App;
use vendor\libs\Helper;

class DataUsers extends Model
{
    /**
     * Теблица с данными (списком пользователей)
     *
     * @var string
     */
    public $table = 'data_users';



    /**
     * Список полей
     *
     * @var array
     */
    public $fields = [
        'id',
        'sort',
        'full_name',
        'email',
        'address'
    ];



    /**
     * Добавляет новые записи
     *
     * @return boolean
     */
    public function add()
    {
        if(!empty($_POST))
        {
            $insertData = [];

            foreach ($_POST as $key => $value)
            {
                if(in_array($key, $this->fields))
                {
                    $insertData[$key] = $value;
                }
            }

            if(!empty($insertData))
            {
                if($this->insert([$insertData]))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        } else {
            return false;
        }
    }



    /**
     * Редактирует запись
     *
     * @return boolean
     */
    public function editItem($dataFields) {
        if(empty($dataFields)) return false;
        $insertData = [];

        foreach ($dataFields as $key => $value)
        {
            if(in_array($key, $this->fields))
            {
                $insertData[$key] = $value;
            }
        }

        if(!empty($insertData) && !empty($insertData['id']))
        {
            $key = $insertData['id'];
            unset($insertData['id']);

            if($this->update([$key => $insertData]))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }



    /**
     * Редактирует записи
     *
     * @return boolean
     */
    public function edit()
    {
        if(!empty($_POST))
        {
            if(!empty($_POST['items']))
            {
                $result = true;
                foreach ($_POST['items'] as $item)
                {
                    if(!empty($item))
                    {
                        if(!$this->editItem($item))
                        {
                            $result = false;
                        }
                    }
                }
                return $result;

            }
            else
            {
                return $this->editItem($_POST);
            }

        }
        else
        {
            return false;
        }
    }



    /**
     * Удаляет записи
     *
     * @return boolean
     */
    public function remove()
    {
        if(!empty($_POST['id']))
        {
            if(is_array($_POST['id']))
            {
                if($this->delete($_POST['id']))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }
}