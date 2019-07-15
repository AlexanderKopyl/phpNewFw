<?php


namespace app\controllers;



class AppController extends \vendor\core\base\Controller
{
    public $menu;
    public $registry;
    public $meta = [];

    public function __construct($route)
    {
        parent::__construct($route);
        new \app\models\Main;
        $this->menu = \R::findAll('category');
    }

    protected function setMeta($title ='',$desc = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
    }
}