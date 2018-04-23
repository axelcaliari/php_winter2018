<?php

namespace Application\Controllers;

use \Ascmvc\AbstractApp;
use \Ascmvc\Mvc\Controller;
use Application\Models\Entity\Users;


class LoginController extends Controller {
	public static function config(AbstractApp &$app)
    {
        IndexController::config($app);
    }
	
	protected function hydrateArray(Users $object)
    {
        $array['username'] = $object->getUsername();
        $array['password'] = $object->getPassword();
        $array['permission'] = $object->getPermission();
		
        return $array;
    }
	
	
	public function checkLogin($username, $password){			
		$em = $this->serviceManager->getRegisteredService('em1');
		$results_object = $em->find(Users::class, $username);
		
		if (is_object($results_object) && $results_object != null) {
			$results = $this->hydrateArray($results_object);
			
			//check if passwords match
			if($results['password'] == $password){	
				setcookie('loggedin', TRUE, time()+ 40, '/');
				$_SESSION['LOGGEDIN'] = TRUE;
				$_SESSION['REMOTE_USER'] = $username;		
				
				/*$this->view['links']['Log out'] = $this->view['links']['Log in'];
				unset($this->view['links']['Log in']);
				$this->view['links']['Log out'] = 'logout';
				$this->viewObject->assign('view', $this->view);*/
				
				$this->view['saved'] = 1;
			}
			else 
				$this->view['error'] = 0;
		}
		else 
			$this->view['error'] = 1;
        	
	}
	
	/*
	 * Attempt at making a logout function
	 */
	public function logoutAction(){
		session_destroy();
		$this->view['links']['Log in'] = $this->view['links']['Log out'];
		unset($this->view['links']['Log out']);
		$this->view['links']['Log in'] = 'loginPage';
		$this->viewObject->assign('view', $this->view);
		session_start();
	}
	
	public function loginPageAction(){
		$this->view['bodyjs'] = 1;

		// if already connected
		if (isset($_COOKIE['loggedin'])) {	
			$this->view['saved'] = 1;
		}
		
		//Login verification
		if (isset($_POST['submit'])		
			&& !empty($_POST['username'])
			&& !empty($_POST['password'])) {
				
				//filtering POST array
				$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$username = (string) $_POST['username'];
				$password = (string) $_POST['password'];
				
				LoginController::checkLogin($username, $password);		
		}
			
		$this->viewObject->assign('view', $this->view);
		$this->viewObject->display('login.tpl');
	}
	
	
	
}