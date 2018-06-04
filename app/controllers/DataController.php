<?php
/**
 * Контроллер для работы с данными (списком пользователей)
 *
 * Выполняет обработку и вывод списка пользователей
 *
 */
namespace app\controllers;
use app\models\AppUsers;
use app\models\DataUsers;
use vendor\core\App;
use vendor\core\libs\Pagination;
use vendor\libs\Helper;

class DataController extends AppController
{
    /**
     * Текущий пользователь
     *
     * @var object
     */
    public $app_user;


    /**
     * Обработчик который запускается после вызова всех функций в конструкторе
     *
     * @return void
     */
    public function afterConstruct()
    {
        $this->app_user = new AppUsers();
    }



    /**
     * Вывод списка пользователей
     *
     * @return resource
     */
    public function indexAction()
    {

        if(!$this->app_user->isLogin())
        {
            App::$app->Request->redirect('/user/login');
        }

        $authorizedUser = $this->app_user->fields;
        $data_model = new DataUsers();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = $data_model->count();
        $perpage = 10;

        $pObj = new Pagination($page, $perpage, $total);
        $start = $pObj->getStart();


        $data = $data_model->findBySql('SELECT * FROM ' . $data_model->getTableName() . ' ORDER BY sort DESC LIMIT ' . $start . ', ' . $perpage .' ');
        $title = 'Список пользователей';
        $pagination = $pObj->getItems();

        if($this->isAjax())
        {
            $this->layout = false;
            $this->renderView($this->view, compact('title', 'authorizedUser', 'data', 'pagination'));
        }
        else
        {
            $this->setViewData(compact('title', 'authorizedUser', 'data', 'pagination'));
        }
    }



    /**
     * Дабавляет новые записи
     *
     * @return resource
     */
    public function addAction()
    {
        $action = $this->view;
        $this->view = 'entry-form';

        if(!empty($_POST))
        {
            $model = new DataUsers();

            if($model->add())
            {
                $message = [
                    'type' => 'success',
                    'text' => 'Запись успешно создана'
                ];
                $_SESSION['messages'][] = $message;
                if(!$this->isAjax()) App::$app->Request->redirect('/');
        }
            else
            {
                $message = [
                    'type' => 'error',
                    'text' => 'Произошла ошибка записи'
                ];
                $_SESSION['messages'][] = $message;
            }
        }

        $authorizedUser = $this->app_user->fields;
        $title = 'Добавить нового пользователя';


        if($this->isAjax())
        {
            header('Content-type: application/json');
            echo json_encode([
                'title' => $title,
                'action' => $action,
                'messages' => !(empty($_SESSION['messages'])) ? $_SESSION['messages'] : null,
            ]);
            unset($_SESSION['messages']);
            die();
        }
        else
        {
            $this->setViewData(compact('title', 'authorizedUser', 'action'));
        }
    }



    /**
     * Редактирует существующие записи
     *
     * @return resource
     */
    public function editAction()
    {
        $edit = false;
        $action = $this->view;
        $this->view = 'entry-form';
        $model = new DataUsers();
        $userData = null;

        if(!empty($_POST))
        {
            if($model->edit())
            {
                $message = [
                    'type' => 'success',
                    'text' => 'Запись успешно изменена'
                ];
                $_SESSION['messages'][] = $message;
                $edit = true;
                if(!$this->isAjax()) App::$app->Request->redirect('/');
            }
            else
            {
                $message = [
                    'type' => 'error',
                    'text' => 'Запись не удалось изменить'
                ];
                $_SESSION['messages'][] = $message;
            }
        }

        $data = null;

        if(!empty($_GET['id']))
        {
            $data = $model->findOne(intval($_GET['id']));

            if(!$data)
            {
                $message = [
                    'type' => 'error',
                    'text' => 'Не удалось получить запись по id ' . htmlspecialchars($_GET['id'])
                ];
                $_SESSION['messages'][] = $message;
                if(!$this->isAjax()) App::$app->Request->redirect('/');
            }
        }
        else
        {
            if(!$this->isAjax() && !$edit) $_SESSION['errors'][] = 'id записи указан некорректно';
            if(!$this->isAjax()) App::$app->Request->redirect('/');
        }

        $authorizedUser = $this->app_user->fields;
        $title = 'Редактирование данных пользователя';

        if($this->isAjax())
        {
            header('Content-type: application/json');
            echo json_encode([
                'title' => $title,
                'data' => $data,
                'action' => $action,
                'messages' => !(empty($_SESSION['messages'])) ? $_SESSION['messages'] : null,
            ]);
            unset($_SESSION['messages']);
            die();
        }
        else
        {
            $this->setViewData(compact('title', 'authorizedUser', 'data', 'action'));
        }

    }



    /**
     * Удаляет записи
     *
     * @return resource
     */
    public function deleteAction()
    {
        $action = $this->view;
        $this->view = 'index';
        $model = new DataUsers();

        if($model->remove())
        {
            $contRemoveItems = 0;
            if(!empty($_POST['id']))
            {
                $contRemoveItems = count($_POST['id']);
            }

            $message = [
                'type' => 'success',
                'text' =>  ($contRemoveItems == 1) ? 'Запись удалена' : 'Записи удалены'
            ];
            $_SESSION['messages'][] = $message;

            if(!$this->isAjax()) App::$app->Request->redirect('/');
        }
        else
        {
            $message = [
                'type' => 'error',
                'text' => 'Записи удалить не удалось'
            ];
            $_SESSION['messages'][] = $message;
            if(!$this->isAjax()) App::$app->Request->redirect('/');
        }

        if($this->isAjax())
        {
            header('Content-type: application/json');
            echo json_encode([
                'messages' => !(empty($_SESSION['messages'])) ? $_SESSION['messages'] : null,
            ]);
            unset($_SESSION['messages']);
            die();
        }
        else
        {
            if(!$this->isAjax()) App::$app->Request->redirect('/');
        }
    }
}