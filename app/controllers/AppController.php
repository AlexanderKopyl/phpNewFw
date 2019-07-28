<?php


namespace app\controllers;



use fw\core\base\Controller;

class AppController extends Controller
{
    public $menu;
    public $registry;
    public $meta = [];

    public function __construct($route)
    {
        parent::__construct($route);
        new \app\models\Main;
        $this->menu = \R::findAll('categories');
    }

    protected function setMeta($title ='',$desc = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
    }
}