<?php


namespace app\controllers;



use fw\core\App;
use fw\core\base\Controller;
use fw\widgets\language\language;

class AppController extends Controller
{
    public $menu;
    public $registry;
    public $meta = [];

    public function __construct($route)
    {
        parent::__construct($route);
        new \app\models\Main;
        App::$app->setProperties('langs', Language::getLanguages());
        App::$app->setProperties('lang', Language::getLanguage(App::$app->getProperty('langs')));
    }

    protected function setMeta($title ='',$desc = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
    }
}