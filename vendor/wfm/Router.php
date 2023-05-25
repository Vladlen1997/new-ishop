<?php

namespace wfm;

class Router
{

    protected static array $routes = []; #routes table
    protected static array $route = [];

    protected static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

}