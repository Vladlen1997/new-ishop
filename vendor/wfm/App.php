<?php


namespace wfm;


class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
        $this->getParams();
    }

    public function getParams() #params for f-work
    {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperties($k, $v); #name and values
            }
        }
    } #connect params fo f-work

}