<?php


namespace vendor\core;


class Registry
{
    use TSinglton;
    public static $objects = [];

    /**
     * Registry constructor.
     */
    protected function __construct()
    {
        $config = require ROOT . "/config/config.php";
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }

    }


    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {

        // TODO: Implement __get() method.
        if(is_object(self::$objects[$name])){
            return self::$objects[$name];
        }
    }

    /**
     * @param $name
     * @param $obj
     */
    public function __set($name, $obj)
    {
        // TODO: Implement __get() method.
        if(!isset(self::$objects[$name])){
            self::$objects[$name] = new $obj;
        }
    }

    public function getList(){
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }


}