<?php


class Router
{

    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {

        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    /**
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
                if (!isset($route['action'])){
                    $route['action'] = 'index';
                }
//                debug($route);

                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    public static function dispatch($url){
        if (self::matchRoute($url)){
            $controller = self::upperCamelCase(self::$route['controller']);

            if (class_exists($controller)){
                $cObj = new $controller;
                $action = self::lowerCamelCase(self::$route['action']) . "Action";
                if (method_exists($cObj,$action)){
                    $cObj->$action();
                }else{
                    echo "Контроллер <b>$controller::$action</b> не найден";
                }

            }else{
                echo "Контроллер <b>$controller</b> не найден";
            }
        }else{
            http_response_code(404);
            return include '404.html';
        }
    }

    //CamelCase controllers
    protected static function upperCamelCase($name){
        return str_replace(" ","",ucwords(str_replace("-"," ", $name)));

    }

    //camelCase actions
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

}