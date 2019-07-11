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
        $menu = \R::findAll('category');


        $title = "PAGE TITLE";
//        $post = $model->findOne(120,'article_id');
        $data = compact('title','posts','menu');

        $this->set($data);
    }
}