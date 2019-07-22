<?php
namespace app\controllers\admin;

use vendor\core\base\View;

class UserController extends AppController
{

    public function indexAction(){
        View::setMeta('Admin panel :: Главная','Description Admin panel');
        $test = "Test var";
        $data = ['test',2];

//        $this->set(['test' => $test,'data' => $data]);
        $this->set(compact('test','data'));

    }

    public function testAction(){
        echo __METHOD__;
    }

}