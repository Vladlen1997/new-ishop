<?php


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
    }

    public function exceptionHandler(\Throwable $e) #inteface throwable with object $e
    {
        #$this
    }

    protected function logError($message = '', $file = '', $line = '') #error message, file message, line message
    {

    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500) #error numb, error string, error file, error line
    {

    }
}

#set_exception_hendler() // обработчик исключений
#set_error_hendler() // обработчик ошибок