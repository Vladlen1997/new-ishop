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
        if (self::matchRoot($url)) { #query
            echo 'OK';
        } else {
            echo 'NO';
        }
    }

    public static function matchRoot($url): bool #вызову func preg_match и сравню поступивший запрос с шаблоном регулярного выражения маршрутизатора
    {
        foreach (self::$routes as $pattern => $route) #паттерн - шаблон регулярного выражения, рут - массив
        {
            if (preg_match("#{$pattern}#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {  #только строка
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                } #если action пуст, укажу значение по умолчанию
                debug($route);
                return true;
            }
        }
        return false;
    }

}