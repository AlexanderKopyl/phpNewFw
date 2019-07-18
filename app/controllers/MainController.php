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

        $menu = $this->menu;
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