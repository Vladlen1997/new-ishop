<?php


namespace wfm;


class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
    }


    protected function getParams() #params for f-work
    {

    } #connect params fo f-work

}