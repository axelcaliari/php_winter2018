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
            'title' => 'LightMVC Home',
            'author' => 'ETISTA',
            'description' => 'And then there was truly light.',
            'css' =>
            [
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.min.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                $baseConfig['URLBASEADDR'] . 'css/bootstrap.custom.css',
                $baseConfig['URLBASEADDR'] . 'css/dashboard.css',
                
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
                
            ],
            'navMenu' =>
            [
                'Home' => $baseConfig['URLBASEADDR'] . 'index.php',
                
            ],
        
        ];
        
        $app->appendBaseConfig('view', $view);
    }
    
    public function indexAction()
    {
        session_start();
        $this->view['bodyjs'] = 1;
        $this->view['pageBody'] = "\t\t\t\t<h1>Welcome to  {$this->view['appname']}!</h1>";
        $this->view['pageBody'] .= "\t\t\t\t<p>You can see all the furnitures available
         and sell your own furnitures if you have an account !</p>";

        $this->viewObject->assign('view', $this->view);
        $this->viewObject->display('index.tpl');
    }



    
    public function testAction()
    {
        $em = $this->serviceManager->getRegisteredService('database');
        
        // get query builder
        try {
            $qb = $em->createQueryBuilder();
            $qb->select('c')
            ->from('Application\Models\Entity\Customers', 'c')
            ->where('c.id = :idn')
            ->setParameter(':idn', $_GET['idn']);
        
            
            if ($result = $qb->getQuery()->getResult()) {
                echo "{$result[0]->getLastName()}, {$result[0]->getFirstName()}<br />";
            }
        }
        catch (Exception $e) {
            echo PHP_EOL . $e->getMessage();
        }
        
    }
    
}