<?php


namespace vendor\core;


class Db{
    use TSinglton;
    protected $pdo;

    public static $countSql = 0;
    public static $queries = [];

    /**
     * Db constructor.
     */
    protected function __construct(){
        $db = require ROOT . "/config/config_db.php";
        require LIBS . "/rb.php";
        \R::setup( $db['dsn'],$db['user'],$db['pass']);
        \R::freeze(true);
//        \R::fancyDebug( true);

    }




}