<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;


class NotfoundController extends Controller
{

    public function indexAction()
    {
        echo 'BOOM!';
        exit;

        header('HTTP/1.0 404 Not Found', true, 404);

        $this->view['bodyjs'] = 1;
        
        $this->view['pageBody'] = "\t\t\t<div class=\"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main\">";
        $this->view['pageBody'] .= "\t\t\t\t<h1>Page Not Found</h1>";
        $this->view['pageBody'] .= "\t\t\t\t<p>Sorry, but the page you were trying to view does not exist.</p>";
        $this->view['pageBody'] .= "</div>";
        
        $this->viewObject->assign('view', $this->view);
        
        $this->viewObject->display('index_index.tpl');
    }
    
}