<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;


class MainController extends AppController
{
    public $layout = 'main';


    public function indexAction()
    {

        $model = new Main;

        $total = \R::count('posts');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 2;

        $pagination = new Pagination($page,$perpage,$total);
        $start = $pagination->getStart();
        $posts = \R::findAll('posts',"LIMIT $start, $perpage");
        $menu = $this->menu;
        View::setMeta('View page','Desc page');
        $data = compact('menu','posts','pagination','total');

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