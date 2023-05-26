<?php


namespace wfm;


class View
{

    public string $content = '';

    public function __construct(public $route, public $layout = '', public $view, public $meta = [])
    {
        if (false !== $this->layout) { # если свойство layout не равняется false
            $this->layout = $this->layout ?: LAYOUT; #layout можно переопределить через контроллер
        }
    }

    public function render($data) # отрисовка
    {
        if(is_array($data)) {
            extract($data); #берёт данные по ключам и создаёт соответствующие переменные
        }
    }
}