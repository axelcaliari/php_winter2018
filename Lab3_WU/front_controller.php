<?php

/*
 * This file should contain your front controller and basic routing mechanism
 * in order to call the appropriate controller contained in the 'include' folder.
 */

$url_array = parse_url($_SERVER["REQUEST_URI"]); // parse the request url into an array
$path = explode("/", $url_array["path"]); // split the string in the path case into a array
$controllerOption = $path[sizeof($path)-1]; // assign the last case of path array, which is the name of controller file to the controllerOption
$funtionOptions = explode("&", $url_array["query"]); // split the query options in the path case into the function option array

/*
 * url example : "http://localhost/phpwinter2018/Lab3_WU/front_controller.php/controller2?f1&f2"
 * */
switch ($controllerOption) {
    // controller1
    case 'controller1':
        include 'include/controller1.php';
        break;
    // controller2
    case 'controller2':
        include 'include/controller2.php';
        break;
    // not found page
    default:
        echo "<h1>page not found !!</h1>";
        break;
}
?>