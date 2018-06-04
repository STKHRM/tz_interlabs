<?php
/**
 * Модель для работы с пользователями системы
 *
 * Выполняет авторизацию пользователей
 *
 */

namespace app\models;
use vendor\core\base\Model;
use vendor\libs\Helper;

class AppUsers extends Model
{
    /**
     * Теблица пользователей системы
     *
     * @var string
     */
    public $table = 'app_users';



    /**
     * Поля пользователя
     *
     * @var array
     */
    public $fields = [
        'id' => null,
        'login' => null,
        'password' => null,
        'email' => null
    ];



    /**
     * Метка авторизации пользователя
     *
     * @var boolean
     */
    private $authorized = false;



    /**
     * Обработчик, который запускается после вызова всех функций в конструкторе
     *
     * @return void
     */
    public function afterConstruct()
    {
        $this->login();
    }



    /**
     * Возвращает метку авторизованности пользователя
     *
     * @return boolean
     */
    private function getAuthorized()
    {
        return $this->authorized;
    }



    /**
     * Принудительно устанавливает авторизованность пользователя
     *
     * @return boolean
     */
    private function setAuthorized($val)
    {
        if(is_bool($val)) $this->authorized = $val;
    }



    /**
     * Проверяет авторизован ли посетитель
     *
     * @return boolean
     */
    public function isLogin()
    {
        return $this->getAuthorized();
    }



    /**
     * Метод непосредственно осуществляет процесс авторизации пользователя.
     *
     * @return boolean
     */
    public function login()
    {

        if(!empty($_SESSION['user']['id']) && empty($_POST))
        {
            $this->fields = $_SESSION['user'];
            $this->setAuthorized(true);
            return true;
        }
        else if(isset($_POST['login']))
        {
            $login = !empty($_POST['login']) ? trim($_POST['login']) : null;
            $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

            if($login && $password)
            {
                $hash = md5($password);

                $user = $this->findOne($login, 'login');

                if (!empty($user['password']))
                {
                    if ($hash === $user['password'])
                    {
                        foreach ($user as $key => $value)
                        {
                            if(array_key_exists($key, $this->fields))
                            {
                                $this->fields[$key] = $value;
                            }
                        }

                        $_SESSION['user'] = $this->fields;
                        $this->authorized = true;

                        return true;
                    }
                    else
                    {
                        $message = [
                            'type' => 'error',
                            'text' => 'Ошибка! Неправильное имя пользователя или пароль'
                        ];
                        $_SESSION['messages'][] = $message;
                    }
                }
            }
            else
            {
                $message = [
                    'type' => 'error',
                    'text' => 'Ошибка! Введите имя пользователя и пароль'
                ];
                $_SESSION['messages'][] = $message;
            }
        }

        return false;
    }

}