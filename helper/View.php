<?php

namespace Helper;
use Model\Page as Page;

class View
{
    private $viewDirectory = "./view/";

    public function renderView($viewName, Array $values)
    {
        $renderHTML = file_get_contents($this->viewDirectory . "layout/base.html");
        foreach ($values as $key => $value) {
            $renderHTML = str_replace($key, $value, $renderHTML);
        }
        echo $renderHTML;
    }

    static function GetMenu()
    {
        $page = new Page;
        $menuTitle = $page->getAllTitle();
        $menu = "<header><nav><ul>";
        foreach ($menuTitle as $value) {
            $title = ucfirst($value['title']);
            $menuName = $value['title'];
            $menu .= "<li><a href='/$menuName'>$title</a></li>";
        }
        $menu .= "</ul></nav></header>";
        return $menu;
    }

    static function editPage($title) 
    {
        $page = new Page;
        $page = $page->getOne('title', $title);
        $view = file_get_contents('./view/editView.html');
        $renderHTML = str_replace('{{TITLE}}', $page['title'], $view);
        $renderHTML = str_replace('{{CONTENT}}', $page['content'], $renderHTML);
        $renderHTML = str_replace('{{ID}}', $page['id'], $renderHTML);

        echo $renderHTML;   
    }
}