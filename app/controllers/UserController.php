<?php
/**
 * Контроллер для работы с пользователями системы
 *
 * Выполняет авторизацию пользователей
 *
 */

namespace app\controllers;
use app\models\AppUsers;
use vendor\core\App;
use vendor\core\Request;
use vendor\libs\Helper;

class UserController extends AppController
{
    /**
     * Авторизация
     *
     * @return void
     */
    public function loginAction()
    {
        $app_user = new AppUsers();

        if($app_user->isLogin())
        {
            App::$app->Request->redirect('/');
        }

        $title = 'Авторизация';
        $this->setViewData(compact('title', 'h1'));
    }



    /**
     * Разлогинивание
     *
     * @return void
     */
    public function logoutAction()
    {
        unset($_SESSION['user']);
        App::$app->Request->redirect('/user/login');
    }
}