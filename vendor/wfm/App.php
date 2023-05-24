<?php


namespace wfm;


class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
    }
}