<?php

namespace vendor\core;

class Router
{
    /**
     * @var array
     */
    protected static $routes = [];
    /**
     * @var array
     */
    protected static $route = [];

    /**
     * Добавляет маршруты
     * @param $regexp(регулярное выражение как ключь)
     * @param array $route(Текущий маршрут)
     */
    public static function add($regexp, $route = [])
    {

        self::$routes[$regexp] = $route;
    }

    /**
     * Все маршруты на сайте.
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Текущий маршрут
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Функция перебирает маршруты и ищет совпадения
     * @param $url
     * @return bool
     */
    protected static function matchRoute($url)
    {

        foreach (self::$routes as $pattern => $route) {

            if (preg_match("#$pattern#i",$url,$matches)) {
//
                foreach ($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
//
                if (!isset($route['action'])){
                    $route['action'] = 'index';
                }
//                debug($route);

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }


    /**
     * Основная функция которая получает $url и обрабатывает и
     * перенапрявляет по коректному пути
     * @param $url
     * @return mixed
     */
    public static function dispatch($url){
        $url = self::removeQueryString($url);
        //Если есть совпадение
        if (self::matchRoute($url)){
            //Подключаем контроллер
            //Подключение происходит по namespace
            $controller = 'app\controllers\\'. self::$route['controller'] . 'Controller';

            //Проверяем еслить ли такой класс по namespace
            if (class_exists($controller)){
                //Если такой класс существует то создаем новый обьект и передаем параметр self::$route
                $cObj = new $controller(self::$route);
                //Action Класса
                $action = self::lowerCamelCase(self::$route['action']) . "Action";
                //Проверяем есть ли такой метод в классе
                if (method_exists($cObj,$action)){
                    //Если Action был найден то выполняем его
                    $cObj->$action();
                    //Выводим нужный вид и передаем переменный в него
                    $cObj->getView();
                }else{
                    echo "Контроллер <b>$controller::$action</b> не найден";
                }

            }else{
                echo "Контроллер <b>$controller</b> не найден";
            }
        }else{
            //Если ничего не найдено выводим ошибку 404
            http_response_code(404);
            return include '404.html';
        }
    }

    //CamelCase controllers
    protected static function upperCamelCase($name){
        /**
         * ucwords — Преобразует в верхний регистр первый символ каждого слова в строку
         */
        return str_replace(" ","",ucwords(str_replace("-"," ", $name)));

    }

    //camelCase actions
    protected static function lowerCamelCase($name){
        /**
         *lcfirst — Преобразует первый символ строки в нижний регистр
         */
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * Функция разрешающая использовать $_GET параметры
     * @param $url
     * @return string
     */
    protected static function removeQueryString($url){
        /*
         * strpos — Возвращает позицию первого вхождения подстроки
         * explode — Разбивает строку с помощью разделителя
         * rtrim — Удаляет пробелы (или другие символы) из конца строки
         */
        if ($url){
            $params = explode('&',$url,2);
            if(false === strpos($params[0],'=')){
                return rtrim($params[0],'/');
            }else{
                return '';
            }
        }
        return $url;
    }

}