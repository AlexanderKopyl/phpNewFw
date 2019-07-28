<?php


namespace fw\widgets\menu;


use fw\libs\Cache;

class Menu
{
    /**
     *
     * @var array
     */
    protected $data;

    /**
     * tree menu
     * @var array
     */
    protected $tree;

    /**
     *
     * @var array
     */
    protected $menuHtml;
    /**
     * @var string
     */
    protected $tpl;
    /**
     * @var string
     */
    protected $container = 'ul';
    /**
     * @var string
     */
    protected $class = 'menu';
    /**
     * @var string
     */
    protected $table = 'categories';
    /**
     * @var number
     */
    protected $cache = 3600;
    /**
     * @var number
     */
    protected $cacheKey = 'fw_menu';


    public function __construct($options = [])
    {
       $this->tpl = __DIR__ . '/menu_tpl/menu.php';
       $this->getOptions($options);
       $this->run();
    }

    public function getOptions($options){
        foreach ($options as $option => $value) {
            if(property_exists($this,$option)){
                $this->$option = $value;
            }
        }
    }
    protected function output(){
        echo "<{$this->container} class='{$this->class}'>";
            echo  $this->menuHtml;
        echo "</{$this->container}>";
    }
    public function run()
    {
        $cache = new Cache();
        $this->menuHtml = $cache->get($this->cacheKey);
        if(!$this->menuHtml){
            $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            $this->tree = $this->getTree();
//        debug($this->tree);
            $this->menuHtml = $this->getMenuHtml($this->tree);
            $cache->set($this->cacheKey,$this->menuHtml,$this->cache);
        }

        $this->output();
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}