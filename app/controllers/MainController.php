<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\App;

class MainController extends AppController
{
    public $layout = 'main';


    public function indexAction()
    {
        $model = new Main;
        $posts = \R::findAll('posts');
//        $posts = App::$app->cache->get('posts');
//        if (!$posts){
//            $posts = \R::findAll('posts');
//            App::$app->cache->set('posts',$posts);
//        }
        $menu = $this->menu;
        $scripts = $this-scripts;
        $this->setMeta('View page','Desc page');

        $meta = $this->meta;
        $data = compact('meta','menu','posts');

        $this->set($data);
    }

    public function testAction(){
        if($this->isAjax()){
            echo 111;
            die;
        }
        echo 222;
//        $this->layout = 'test';
//        $this->setMeta('test page','Desc page');
//        $meta = $this->meta;
//        $menu = $this->menu;
//        $data = compact('meta','menu');
//
//        $this->set($data);
    }



}