<?php

namespace wfm;

class Router
{

    protected static array $routes = []; #routes table
    protected static array $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route; #конкретный маршрут, с которым было найдено соответствие
    }

    public static function dispatch($url)
    {
        if(self::matchRoot($url)) {
            echo 'OK';
        } else {
            echo 'NO';
        }
    }

    public static function matchRoot($url): bool #вызову func preg_match и сравню поступивший запрос с шаблоном регулярного выражения маршрутизатора
    {
        return false;
    }

}