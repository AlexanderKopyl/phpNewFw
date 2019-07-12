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
        $meta = $this->meta;
//        $post = $model->findOne(120,'article_id');
        $data = compact('meta','menu');

        $this->set($data);
    }

    public function testAction(){
        $this->layout = 'test';
        $this->setMeta('test page','Desc page');
        $meta = $this->meta;
        $menu = $this->menu;
//        $post = $model->findOne(120,'article_id');
        $data = compact('meta','menu');

        $this->set($data);
    }

}