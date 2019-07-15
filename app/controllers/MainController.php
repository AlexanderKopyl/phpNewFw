<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
    public $layout = 'main';


    public function indexAction()
    {
        $model = new Main;
        $posts = \R::findAll('posts');
        $menu = $this->menu;
        $this->setMeta('View page','Desc page');
//        $this->registry->getList();
        $this->registry->cache->to();
        $meta = $this->meta;
        $data = compact('meta','menu','posts');

        $this->set($data);
    }

    public function testAction(){

        $this->layout = 'test';
        $this->setMeta('test page','Desc page');
        $meta = $this->meta;
        $menu = $this->menu;
        $data = compact('meta','menu');

        $this->set($data);
    }

}