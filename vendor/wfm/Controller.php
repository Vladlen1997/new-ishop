<?php

abstract class Controller
{

    public array $data = []; #массив с данными
    public array $meta = []; //из контроллера в шаблон передавать метаданные страницы - заголовки,  метоописание и ключевики страницы
    public false|string $layout = ''; #шаблон, в init определён (может быть как false, так и стринг)
    public string $views = ''; # только строка
    public object $model; #также создаю объект моделискуф

    public function __construct(public $route = []) #added construct and
    {

    }

    public function getModel()
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {  # создаём объект, только если есть соответствующий класс
            $this->model = new $model();  # в итоге получаю модель, если таковая создана
        }
    }

    # создаю getView | view можно переопределять через контроллер

    public function getView()
    {
        $this->views = $this->views ?: $this->route['action'];  # если $this->views не пустая строка, тогда запишем её, иначе название вида возьму по умолчанию
        (new View($this->route, $this->layout, $this->views, $this->meta))->render($this->data); # создаю экземпляр класса view и пробрасываю параметры и от этого объекта вызываю метод render
    } # объект вида и метод рендер?


    public function set($data) #данные необходимо куда-то складывать
    {
        $this->data = $data; #в массив мы запишем все те переменные, которые сюда пришли
    }

    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta = [
            'title' => $title, 'description' => $description, 'keywords' => $keywords
        ];
    }

}