<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;


class UserController extends Controller {
    
    
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
    
    public function loginAction () 
    {
        /*$hash = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
        var_dump(password_verify("rasmuslerdorf", $hash));*/
        session_start();
        if (isset($_POST["firstname"]) && isset($_POST["password"]))
        {
            $firstname = $this->validation($_POST['firstname']);
            $password = $this->validation($_POST['password']);
        

        
            try {
            $conn = $this->serviceManager->getRegisteredService('database');
            $qb = $conn->createQueryBuilder();
            $qb->select('*')
            ->from('customers')
            ->where('firstname = :firstname');
            $data = array(':firstname' => $firstname);

            $stmt = $conn->prepare($qb->getSql());
            $stmt->execute($data);

            // fetch results after prepare and execute
            while ($row = $stmt->fetch()) {
                if (password_verify($password,  $row['password']))
                {
                        $_SESSION["user"] = $row;
                        header("Location: account");
                }
            }

            } catch (Exception $e) { echo PHP_EOL . $e->getMessage(); }
        
        }
    

        $this->view['bodyjs'] = 0;
        $this->viewObject->assign('view', $this->view);
        $this->viewObject->display('user_login.tpl');
    }


    public function accountAction () 
    {
        session_start();
        /*$hash = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
        var_dump(password_verify("rasmuslerdorf", $hash));*/
        if (isset($_SESSION["user"]))
        {
            $this->view['bodyjs'] = 0;
            $this->view['user'] = $_SESSION["user"];
            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('user_account.tpl'); 
        }
        else 
        {
            $this->view['bodyjs'] = 0;
            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('user_error.tpl');
        }
    }

    public function logoutAction () 
    {
        session_start();
        /*$hash = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
        var_dump(password_verify("rasmuslerdorf", $hash));*/
        unset($_SESSION['user']);
        header("Location: http://localhost/lightmvctest/public/index.php/index");
    }


    private function validation ($string) {
        // string input validation
        $cleaned = (string) $string;
        $cleaned = trim($cleaned);
        $cleaned = htmlspecialchars($cleaned);
        $cleaned = strip_tags($cleaned);
        return $cleaned;
    }
    
}