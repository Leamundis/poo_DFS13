<?php
namespace Helper;
use Controller\Dispatcher as Dispatcher;
use Model\Page as Page;

class Router
{
    private function trimUri($uri)
    {
        $this->edit = false;
        $uri = substr($uri, 1);
        $uris = explode('/', $uri);
        if (count($uris) == 2 && $uris[1] == 'edit' || count($uris) == 3 && $uris[2] == '' ) {
            $this->edit = true;
        }
        return $uris;
    }

    public function route()
    {
        $uri = $this->trimUri($_SERVER['REQUEST_URI']);
        if ($uri[0] == 'save') {
            $page = new Page;
            $page = $page->savePage($_POST);
        }
        $dispatcher = new Dispatcher($uri);
        if ($this->edit == true) {
            $dispatcher->editView();
        } else {
            $dispatcher->view();
        }
    }

/*
    public function route()
    {
        $uri = $this->trimUri($_SERVER['REQUEST_URI']);
        $dispatcher = new Dispatcher();
        if (method_exists($dispatcher, $uri)) {
            $dispatcher::$uri();
        } else {
            $dispatcher::code404();
        }
    }
*/

}
