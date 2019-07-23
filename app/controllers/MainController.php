<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MainController extends AppController
{
    public $layout = 'main';


    public function indexAction()
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(ROOT . '/tmp/your.log', Logger::WARNING));

// add records to the log
        $log->warning('Foo');
        $log->error('Bar');

        $mail = new PHPMailer;
        var_dump($mail);
        
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