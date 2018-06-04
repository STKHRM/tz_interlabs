<?php
/**
 * Обработчик ошибок
 */

namespace vendor\core;

class ErrorHandler
{

    /**
     * Конструктор
     *
     * @var void
     */
    public function __construct()
    {
        if(DEBUG)
        {
         error_reporting(-1);
        }
        else
        {
         error_reporting(0);
        }

        set_error_handler([$this, 'errorHandler']); // Не фатальные ошибки
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']); // Фатальниые ошибки
        set_exception_handler([$this, 'exceptionErrorHandler']); // Исключения
    }



    /**
     * Обработчик не фатальных ошибок
     *
     * @param int $errno уровень ошибки
     * @param string $errstr сообщение об ошибке
     * @param string $errfile имя файла, в котором произошла ошибка
     * @param int $errline номер строки, в которой произошла ошибка
     *
     * @return void
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $errname = self::FriendlyErrorType($errno);
        $this->log($errstr, $errfile, $errline);
        $this->display($errno, $errstr, $errfile, $errline);
    }



    /**
     * Обработчик фатальных ошибок
     *
     * @return void
     */
    public function fatalErrorHandler()
    {
        $err = error_get_last();
        if (!empty($err) && $err['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
        {
            ob_end_clean();
            $this->log($err['message'], $err['file'], $err['line']);
            $this->display($err['type'], $err['message'], $err['file'], $err['line']);
        }
        else
        {
            ob_end_flush();
        }
    }



    /**
     * Обработчик исключений
     *
     * @param object $err
     *
     * @return void
     */
    public function exceptionErrorHandler($err)
    {
        $this->log($err->getMessage(), $err->getFile(), $err->getLine());
        $this->display('Exception', $err->getMessage(), $err->getFile(), $err->getLine(), $err->getCode());
    }



    /** Запись в лог
     *
     * @param string $message
     * @param string $file имя файла, в котором произошла ошибка
     * @param int $line номер строки, в которой произошла ошибка
     *
     * @return void
     */
    protected function log($message, $file, $line)
    {
        error_log('
            [' . date("Y-m-d H:i:s") . '] ' .
            $message .
            ' File: ' . $file .
            ' Line: ' . $line .
            "\n\n",
        3, ROOT . '/tmp/errors.log');
    }



    /**
     * Вывод в шаблон
     *
     * @param int $errno уровень ошибки
     * @param string $errstr сообщение об ошибке
     * @param string $errfile имя файла, в котором произошла ошибка
     * @param int $errline номер строки, в которой произошла ошибка
     * @param int $response код ответа сервера
     *
     * @return resource
     */
    protected function display ($errno, $errstr, $errfile, $errline, $response = 500)
    {
        $errname = self::FriendlyErrorType($errno);


        if(is_integer($response)) {
            http_response_code($response);
        }
        else
        {
            http_response_code(500);
        }

        if($response === 404)
        {
            require APP . '/views/errors/404.php';
            die();
        }

        if(DEBUG)
        {
            require APP . '/views/errors/dev_errors.php';
        }
        else
        {
            require APP . '/views/errors/prod_errors.php';
        }
        die();
    }



    /**
     * Возвращает строку с названием ошибки
     *
     * @return string
     */
    public static function FriendlyErrorType($type)
    {
        switch($type)
        {
            case E_ERROR: // 1 //
                return 'E_ERROR';
            case E_WARNING: // 2 //
                return 'E_WARNING';
            case E_PARSE: // 4 //
                return 'E_PARSE';
            case E_NOTICE: // 8 //
                return 'E_NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'E_CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR: // 64 //
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING: // 128 //
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'E_USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'E_USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'E_USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'E_USER_DEPRECATED';
        }
        return '';
    }
}