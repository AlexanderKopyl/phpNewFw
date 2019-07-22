<?php


namespace vendor\core\base;

use vendor\core\Registry;

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


    /**
     * Controller constructor.
     * @param $route
     */
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

    /**
     * Проверяет был ли запрос вызван методом Adjax
     * @return bool
     */
    public function isAjax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Подключает View странице
     * @param $view
     * @param array $vars
     */
    public function loadView($view,$vars = []){
        extract($vars);
        require APP . "/views/{$this->route['controller']}/{$view}.php";
    }


}