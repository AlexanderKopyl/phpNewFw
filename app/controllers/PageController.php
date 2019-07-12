<?php


namespace app\controllers;

use app\models\Main;

class PageController extends AppController {

//    public $layout;

    public function viewAction(){
        $this->layout = 'view';
        $model = new Main;
        $menu = $this->menu;


        $this->setMeta('View page','Desc page');
        $meta = $this->meta;
        $data = compact('meta','menu');

        $this->set($data);
    }


}