<?php

use fw\core\Router;

require '../vendor/fw/libs/functions.php';
require '../vendor/autoload.php';

define("DEBUG",1);
define("WWW", __DIR__);
define("CORE", dirname(__DIR__) . '/vendor/fw/core');
define("LIBS", dirname(__DIR__) . '/vendor/fw/libs');
define("ROOT",dirname(__DIR__));
define("APP",dirname(__DIR__) . "/app");
define("CACHE",dirname(__DIR__) . "/tmp/cache");
define("LOG",dirname(__DIR__) . "/tmp/log");
define("LAYOUT",'default');

/**
 * spl_autoload_register — Регистрирует заданную функцию в качестве реализации метода __autoload()
 */
//spl_autoload_register(function ($class){
//    $file = ROOT . '/' . str_replace('\\','/', $class) . '.php';
//    if (is_file($file)){
//        require_once $file;
//    }
//});
new fw\core\App;
/**
 * Переменная текущего запроса..
 */
$query = $_SERVER['QUERY_STRING'];


Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller'=> 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$',['controller'=> 'Page','action' => 'view']);

//defaults route
Router::add('^admin$',['controller'=> 'User','action' => 'index','prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$',['prefix' => 'admin']);

Router::add('^$',['controller'=> 'Main','action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

/**
 * Вызов основной функций роутера..
 * @param string
 */
Router::dispatch($query);

