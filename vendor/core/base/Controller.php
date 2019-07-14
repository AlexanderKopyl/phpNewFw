<?php


namespace vendor\core\base;


abstract class Controller
{
    /**
     * текущий маршрут и параметры (сontroller,action,params)
     * @var array
     */
    public $route = [];
    /**
     * текущий вид
     * @var string
     */
    public $view;
    /**
     * текущий шаблон
     * @var string
     */
    public $layout;
    /**
     * Пользовательский даные
     * @var array
     */
    public $vars;



    public function __construct($route){
        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     * Функция добавления класса View и рендер шаблога и переменных на страницу
     */
    public function getView(){
        $vObj = new View($this->route,$this->layout,$this->view);
        $vObj->render($this->vars);
    }

    /**
     * Устанавливает переменные которые нужно передать в класс View
     * @param $vars
     */
    public function set($vars){
        $this->vars = $vars;
    }
}