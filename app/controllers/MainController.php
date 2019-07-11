<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
    public $layout = 'main';


    public function indexAction()
    {
        $model = new Main;
//        $res = $model->query("CREATE TABLE posts SELECT * FROM operationebashu.oc_article_description;");
        $posts = $model->findAll();

        $title = "PAGE TITLE";
        $post = $model->findOne(120,'article_id');
        $data = compact('title','posts','post');

        $this->set($data);
    }
}