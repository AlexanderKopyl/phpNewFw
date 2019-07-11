<?php

namespace app\controllers;

class Main extends App
{
    public $layout = 'main';

    public function indexAction()
    {
//        $this->layout = false;
//        $this->layout = 'main';
//        $this->view = 'test';
        $name = "Alexsander";
        $hi = "Hello";
        $title = "PAGE TITLE";

        $data = compact('name','hi','title');

        $this->set($data);
    }
}