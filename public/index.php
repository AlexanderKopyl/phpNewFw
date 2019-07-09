<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
//require '../app/controllers/Main.php';
//require '../app/controllers/Posts.php';
//require '../app/controllers/Page.php';
//require '../app/controllers/PostsNew.php';
spl_autoload_register(function (){
    $file = '';
});

$query = $_SERVER['QUERY_STRING'];


Router::add('^$',['controller'=> 'Main','action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);

