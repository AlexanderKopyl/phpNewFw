<?php


namespace fw\libs;


class Pagination
{
    //Текущая страница
    public $currentPage;
    //По сколько записей нужно выводить на страницу
    public $perpage;
    //Общее количество записей
    public $total;
    //Общее количество страниц
    public $countPages;
    //Базовый адрес к которому добавляется страница
    public $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurentPage($page);
        $this->uri = $this->getParams();
    }

    public function getCurentPage($page)
    {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;

        return $page;
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("?", $url);
        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }

        }
        return $uri;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null; //ссылка Назад
        $forward = null; //ссылка Вперед
        $startpage = null; // ссылка в Начало
        $endpage = null; // ссылка в Конец
        $page2left = null; // вторая страница с лева
        $page1left = null; //первая страница с лева
        $page2right = null; // вторая страница с права
        $page1right = null; // первая страница с права

        if ($this->currentPage > 1) {
            $back = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if ($this->currentPage < $this->countPages) {
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        if ($this->currentPage > 3) {
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if ($this->currentPage < ($this->countPages - 2)) {
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if ($this->currentPage - 2 > 0) {
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }
        if ($this->currentPage - 1 > 0) {
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }
        if ($this->currentPage + 1 <= $this->countPages){
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }
        if ($this->currentPage + 2 <= $this->countPages){
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }

        return '<ul class="pagination">'.$startpage.$back.$page2left.$page1left.'<li class="active">
        <a href="">'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage.'</ul>';
    }

}
