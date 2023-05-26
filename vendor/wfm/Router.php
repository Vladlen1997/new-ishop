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

    #removeQueryString - служебный метод, обрезка лишнего запроса

    protected static function removeQueryString($url) # str_contains - проверит, есть ли в заданной строке подстрока
    {
        if($url) {
            $params = explode('&', $url, 2); # explode разбивает строку на элементы массива. Не имеет значения, что идёт после амперсанда. Делим строку на 2 элемента.
            if(false === str_contains($params[0], '=')) {  #str_contains проверяет заданную строку на подстроку
                return rtrim($params[0], '/');
            }
        }
        return '';
    }



    public static function dispatch($url)
    {
        $url = self::removeQueryString($url); #пропускаю url через removeQuery (убираю строку запроса из самого запроса)
        if (self::matchRoot($url)) { #query
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';//адрес теперь получается app controllers, далее admin*, и наименование контроллера. Либо без админки если ''
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route); #передал в конструктор текущий маршрут
                $action = self::lowerCamelCAse(self::$route['action'] . 'Action');# пристыковал постфикс. (Если не указать постфикс, то данный метод будет вызываться как служебный и вызваться не сможет)
                if (method_exists($controllerObject, $action)) { #indexAction
                    $controllerObject->$action();
                } else {
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }

        } else {
            throw new \Exception("Страница не найдена", 404); #если false, то не найдено совпадение в таблице маршрутов и выбрасываю исключение
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

                if (!isset($route['admin_prefix'])) { #проверяю, существует лиn такой ключ admin_prefix
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\'; # добавил слэш в конце для пространства имён, при работе с админкой понадобится
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route; #записал весь результат в качестве текущего маршрута
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        //new-product => new product
        // $name = str_replace('-', ' ', $name); #заменяю дефис на пустую строку в $name
        //new product => New Product
        // $name = ucwords($name); #ucwords функция преобразует первый символ каждого слова в верхний регистр
        //New Product => NewProduct
        // $name = str_replace(' ', '', $name); #удалил пробел в $name
    }

    protected static function lowerCamelCAse($name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }

}