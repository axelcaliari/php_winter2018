<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;


class IndexController extends Controller {
    
    public static function config(AbstractApp &$app)
    {
        $baseConfig = $app->getBaseConfig();
        
        $view = [
            'logo' => $baseConfig['URLBASEADDR'] . 'img/logo.png',
            'favicon' => $baseConfig['URLBASEADDR'] . 'favicon.ico',
            'appname' => $baseConfig['appName'],
            'title' => "Webedia Shop",
            'author' => 'Caliari Axel',
            'description' => 'Small CRUD application',
            'css' =>
            [
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.min.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.custom.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                $baseConfig['URLBASEADDR'] . 'css/login.css',
				
            ],
            'js' =>
            [
                $baseConfig['URLBASEADDR'] . 'js/jquery.min.js',
                $baseConfig['URLBASEADDR'] . 'js/bootstrap.min.js',
                
            ],
            'jsscripts' =>
            [
                //"<script>\n\t\tfunction getPage(page) {\n\n\t\t\tvar url = page;\n\n\t\t\tjq( \"#pageBody\" ).load( url );\n\n\t\t}\n\t</script>\n",
        
            ],
            'links' =>
            [
                'Home' => $baseConfig['URLBASEADDR'] . 'index.php',
                'Log in' => $baseConfig['URLBASEADDR'] . 'index.php/login/loginPage',
				'Products' => $baseConfig['URLBASEADDR'] . 'index.php/product/index'
            ],
            'navMenu' =>
            [
                'Home' => $baseConfig['URLBASEADDR'] . 'index.php',
                
            ],
			'results' => null,
			'saved' => 0,
			'error' => 0,
			'permission' => 0
        ];
        
        $app->appendBaseConfig('view', $view);
    }

    public function indexAction()
    {
        $this->view['bodyjs'] = 1;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('index_index.tpl');
    }
	
	public function loginAction(){
		$this->view['bodyjs'] = 1;

        $this->viewObject->assign('view', $this->view);

        $this->viewObject->display('login.tpl');
	}
		
}