<?php

/*
 * This file should contain your front controller and basic routing mechanism
 * in order to call the appropriate controller contained in the 'include' folder.
 */

function currentPageURL() {

    $url = $_SERVER['REQUEST_URI'];

    if((parse_url($url))["query"] == 'controller1'){
        include 'include/controller1.php';
        ctrl();
    }
    elseif((parse_url($url))["query"] == 'controller2'){
        include 'include/controller2.php';
        ctrl();
    }
    else{
        echo 'Oupsi doopsie';
    }
}

currentPageURL();
