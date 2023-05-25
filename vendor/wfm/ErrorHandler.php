<?php

//https://habr.com/ru/post/161483/

namespace wfm;


class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']); #method exceptionHandler
        set_error_handler([$this, 'ErrorHandler']); #error handler
        ob_start(); #turn on buferization
        register_shutdown_function([$this, 'fatalErrorHandler']); #fatal error
    }


    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last(); //get last error
        if(isset($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) { # получили последнюю ошибку и если она не пуста и тип ошибки который можем обработать
            $this->logError($error['message'], $error['file'], $error['line']); #логируем ошибку
            ob_end_clean(); #выключаем буфер
        }
    }


    public function exceptionHandler(\Throwable $e) #inteface throwable with object $e
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());#catch the error and log it
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());#catch the error and show it
    }

    protected function logError($message = '', $file = '', $line = '') #error message, file message, line message
    {
        file_put_contents(LOGS . '/errors.log',
            "[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n=================\n",
            FILE_APPEND); #the exception will be recorded in the log
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500) #error numb, error string, error file, error line
    {
        if ($responce == 0) {
            $response = 404; #in title
        }
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }

        if (DEBUG) {
            require_once WWW . '/errors/development.php';
        } else {
            require_once WWW . '/errors/production.php';
        }
        die;
    }
}

#set_exception_hendler() // обработчик исключений
#set_error_hendler() // обработчик ошибок