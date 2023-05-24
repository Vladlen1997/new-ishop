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
        set_error_handler([$this, 'exceptionHandler']); #method exceptionHandler
    }

    public function exceptionHandler(\Throwable $e) #inteface throwable with object $e
    {

    }
}

#set_exception_hendler() // обработчик исключений
#set_error_hendler() // обработчик ошибок