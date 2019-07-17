<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\App;
use vendor\core\base\View;

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
        $scripts = $this->scripts;
        View::setMeta('View page','Desc page');
        $data = compact('menu','posts');

        $this->set($data);
    }

    public function testAction(){
        if($this->isAjax()){
            $post = \R::findOne('posts','id='.$_POST['id']);
            $this->loadView('_test',compact('post'));
            die;
        }
        echo 222;
    }



}