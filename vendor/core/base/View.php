<?php


namespace vendor\core\base;


class View{

    /**
     * текущий маршрут и параметры (сontroller,action,params)
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * Массив скриптов
     * @var string
     */
    public $scripts = [];

    /**
     *
     */
    public static $meta = ['title' => '', 'desc' => ''];
    /**
     * View constructor.
     * @param $route
     * @param string $layout
     * @param string $view
     */

    public function __construct($route,$layout='',$view = ''){
        $this->route = $route;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?:LAYOUT;
        }
        $this->view = $view;
    }

    /**
     * @param $vars
     *
     */
    public function render($vars){

        if(is_array($vars)){
            extract($vars);
        }

        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";

        ob_start();
        if(is_file($file_view)){
            require  $file_view;
        }else{
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }

        $content = ob_get_clean();

        if (false !== $this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout)){
                //Обработка контента методом вырезающий скрипты
                $content = $this->getScript($content);
                $scripts = [];
                if (!empty($this->scripts[0])){
                    $scripts = $this->scripts[0];
                }

                require $file_layout;
            }else{
                echo "Файл <b>$file_layout</b> не найден";
            }
        }


    }

    /**
     * Вырезает скрипты с view
     * @param $content
     * @return string|string[]|null
     */
    public function getScript($content){
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern,$content,$this->scripts);
        if (!empty($this->scripts)){
            $content = preg_replace($pattern,'',$content);
        }

        return $content;
    }

    /**
     * Функция возвращает мета теги страницы
     *return html
     */
    public static function getMeta(){
        echo '<title>'. self::$meta['title'] . '</title>
        <meta name="description" content="'. self::$meta['desc'].'">
    ';
    }

    /**
     * Устанавливает мета теги страницы
     * @param string $title
     * @param string $desc
     */
    public static function setMeta($title = '',$desc = ''){
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
    }

}