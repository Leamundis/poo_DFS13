<?php
namespace Controller;
use Helper\View as View;
use Model\Page as Page;


class Dispatcher
{

    function __construct($uris)
    {
        $this->uris = $uris;
        $this->uri = $uris[0];
    }

    public function view()
    {
        //var_dump($this->uris); die;
        $view = new View;
        $page = new Page;
        $onePage = $page->getOne('title', $this->uris[0]);
        if ($onePage == false || (count($this->uris) == 2 && $this->uris[1] != "") || (count($this->uris) > 1 && $this->uris[1] != "" )) {
            $onePage = $page->getOne('title', 'error');
        }
        $view->renderView(__FUNCTION__, [
            '{{TITLE}}' => ucfirst($onePage['title']),
            '{{CONTENT}}' => $onePage['content'],
            '{{MENU}}' => View::getMenu()
        ]);
    }

    public function editView()
    {
        $view = new View;
        $view::editPage($this->uri);
    }


/*
    static function contact()
    {
        $view = new View;
        $page = new Page;
        $onePage = $page->getOne('title', __FUNCTION__);
        $view->renderView(__FUNCTION__, [
            '{{TITLE}}' => ucfirst($onePage['title']),
            '{{CONTENT}}' => $onePage['content']
        ]);
    }

    static function code404()
    {
        var_dump("Error, you're too silly!"); die;
    }
*/
}