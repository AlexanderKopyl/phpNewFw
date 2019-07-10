<?php
namespace app\controllers;

class Posts
{
    public $route = [];

    public function __construct($route){
        $this->route = $route;
    }

    public function indexAction()
    {
        echo "Posts - ALL fine";
    }
    public function testAction()
    {
        debug($this->route);
        echo "Posts - ALL fine";
    }
}