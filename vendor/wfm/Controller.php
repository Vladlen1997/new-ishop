<?php

abstract class Controller
{

    public array $data = []; #массив с данными
    public array $meta = ['title' => '', 'description' => '', 'keywords' => '']; //из контроллера в шаблон передавать метаданные страницы - заголовки,  метоописание и ключевики страницы
    public false|string $layout = ''; #шаблон, в init определён (может быть как false, так и стринг)
    public string $views = ''; # только строка
    public object $model; #также создаю объект модели
    public function __construct(public $route = []) #added construct and
    {

    }
}