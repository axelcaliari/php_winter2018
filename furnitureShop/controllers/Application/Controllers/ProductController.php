<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;


class ProductController extends Controller {
    
    
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

    public function addAction () 
    {
        session_start();
        $this->view['bodyjs'] = 0;
        $this->viewObject->assign('view', $this->view);
        $this->viewObject->display('product_add.tpl');
    }

    public function updateAction () 
    {
        session_start();

        if (isset($_POST["name"]) && isset($_POST["description"])  && isset($_POST["price"])
             && isset($_POST["picture"]))
        {
            if ($this->verify_product($_POST["name"], $_POST["description"], $_POST["price"], $_POST["picture"]))
            {
                if(isset($_SESSION["user"])) {
                      try {
                    $conn = $this->serviceManager->getRegisteredService('database');

                    $conn->executeUpdate('UPDATE products SET name = ?, description = ?, 
                            price = ?, picture = ? WHERE id = ?', array($_POST["name"],
                            $_POST["description"], $_POST["price"], $_POST["picture"], $_POST["id"]));


                    } catch (Exception $e) { echo PHP_EOL . $e->getMessage(); }
                       
                    header("Location: http://localhost/lightmvctest/public/index.php/product");  
                }
                else {
                    $this->view['bodyjs'] = 0;
                    $this->viewObject->assign('view', $this->view);
                    $this->viewObject->display('user_error.tpl');
                }
            }
        }

        if (isset($_GET["id"])) 
        {
            $id = (int) $this->validation($_GET["id"]);
            $this->view['bodyjs'] = 0;
            $this->viewObject->assign('view', $this->view);

            // get info of the current product
            $conn = $this->serviceManager->getRegisteredService('database');
            $sql = "SELECT * FROM products WHERE id = ".$id."";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $products = array();
            while ($row = $stmt->fetch()) {
                array_push($products, $row);
            }

            if (!empty($products))
            {
                $this->view['bodyjs'] = 0;
                $this->view['products'] = $products;
                $this->viewObject->assign('view', $this->view);
                $this->viewObject->display('product_update.tpl');
            }
            else 
            {
                echo "Invalid ID";
            }

         
        }
        else 
        {
            echo "parameter error. Id is expected !";
        }
        
    }

    public function deleteAction () 
    {
        session_start();
        if (isset($_SESSION["user"]) && isset($_GET["id"])) 
        {
            $id = (int) $this->validation($_GET["id"]);
            $conn = $this->serviceManager->getRegisteredService('database');
            $qb = $conn->createQueryBuilder();

            $sql = "DELETE FROM products WHERE id = ".$id."";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header("Location: http://localhost/lightmvctest/public/index.php/product/index");

        }
        else 
        {
            $this->view['bodyjs'] = 0;
            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('user_error.tpl');
        }
    }
    
    public function indexAction () 
    {
        session_start();

        if (isset($_GET["id"])) {

            $id = (int) $this->validation($_GET["id"]);
            $conn = $this->serviceManager->getRegisteredService('database');
            $sql = "SELECT * FROM products WHERE id = ".$id."";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $products = array();
            while ($row = $stmt->fetch()) {
                array_push($products, $row);
            }

            $this->view['bodyjs'] = 0;
            $this->view['products'] = $products;
            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('product_see.tpl');

            
        }
        else if (isset($_POST["name"]) && isset($_POST["description"])  && isset($_POST["price"])
             && isset($_POST["picture"]))
        {
            if ($this->verify_product($_POST["name"], $_POST["description"], $_POST["price"], $_POST["picture"]))
            {
                if(isset($_SESSION["user"])) {
                      try {
                     $conn = $this->serviceManager->getRegisteredService('database');


                        $qb = $conn->createQueryBuilder();

                        $qb->insert('products')->values(
                            array(
                                'name' => "'".$_POST["name"]."'",
                                'description' => "'".$_POST["description"]."'",
                                'picture' => "'".$_POST["picture"]."'",
                                'price' => "'".$_POST["price"]."'"
                            )
                        );

                        $stmt = $conn->prepare($qb->getSql());

                        $stmt->execute();

                    } catch (Exception $e) { echo PHP_EOL . $e->getMessage(); }
                       
                    header("Location: http://localhost/lightmvctest/public/index.php/product");  
                }
                else {
                    $this->view['bodyjs'] = 0;
                    $this->viewObject->assign('view', $this->view);
                    $this->viewObject->display('user_error.tpl');
                }

                
            }
            else 
            {
                echo "You didn't fill the form correctly !";
            }
        }
        else 
        {
            
            try {
                $conn = $this->serviceManager->getRegisteredService('database');
                $qb = $conn->createQueryBuilder();
                $qb->select('*')
                ->from('products')->orderBy('id', 'DESC');

                $stmt = $conn->prepare($qb->getSql());
                $stmt->execute();
                    // fetch results after prepare and execute
                $products = array();
                while ($row = $stmt->fetch()) {
                    array_push($products, $row);
                }

            } catch (Exception $e) { echo PHP_EOL . $e->getMessage(); }

            $this->view['bodyjs'] = 0;
            $this->view['products'] = $products;
            $this->viewObject->assign('view', $this->view);
            $this->viewObject->display('product_index.tpl');
        }


        
    }



    private function verify_product($name, $description, $price, $image)
    {
        $name = $this->validation($name);
        $description = $this->validation($description);
        $price = $this->validation($price);
        $image = $this->validation($image);

        if (!(strlen($name) > 3) || !(strlen($name) < 100))
        {
            return false;
        }

        if (!(strlen($description) > 3) || !(strlen($description) < 200))
        {
            return false;
        }

        $price = (int)$price;

        return true;
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