<?php


namespace vendor\widgets\menu;


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
    protected $container;
    /**
     * @var string
     */
    protected $table;
    /**
     * @var string
     */
    protected $cache;


    public function __construct()
    {
       $this->run();
    }

    public function run(){
        $this->data = \R::getAssoc("SELECT * FROM categories");
        $this->tree = $this->getTree();
        debug($this->tree);
    }

    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
            if (!$node['parent']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree,$tab = ''){

    }

    protected function catToTemplate($category,$tab,$id){

    }

}