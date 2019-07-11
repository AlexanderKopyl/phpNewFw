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

        $data = compact('title','posts');

        $this->set($data);
    }
}