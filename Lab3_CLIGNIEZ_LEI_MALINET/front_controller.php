<?php

/*
 * This file should contain your front controller and basic routing mechanism
 * in order to call the appropriate controller contained in the 'include' folder.
 */

include "include/controller1.php";
include "include/controller2.php";

class Front_controller{

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $array = explode("/", $url);

        if (!isset($array[5]) && isset($array[4])) {
            switch ($array[4])
            {
                case 1:
                    $controller = new controller1();
                    break;
                case 2:
                    $controller = new controller2();
                    break;
                default :
                    echo "Wrong input!";
            }
        }
    }
}

$front_controller = new Front_controller();