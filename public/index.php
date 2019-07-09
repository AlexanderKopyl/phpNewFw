<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

$query = $_SERVER['QUERY_STRING'];

Router::add('post/add',['controller'=> 'Posts','action' => 'add']);
Router::add('posts',['controller'=> 'Posts','action' => 'index']);
Router::add('',['controller'=> 'Main','action' => 'index']);

if (Router::matchRoute($query)){
    debug(Router::getRoute());
}else{
    echo '404';
}
