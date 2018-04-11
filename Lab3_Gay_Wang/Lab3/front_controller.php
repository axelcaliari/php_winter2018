<?php



function condition(){

    $url = $_SERVER['REQUEST_URI'];

    if(parse_url($url)["query"] == "a") {
        include "include/controller1.php";
        c1();
    }
    if(parse_url($url)["query"]== "b"){
        include "include/controller2.php";
        c2();
    }

}

condition();

/*
 * This file should contain your front controller and basic routing mechanism
 * in order to call the appropriate controller contained in the 'include' folder.
 */