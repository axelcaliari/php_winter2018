<?php

// This file should contain your second controller.

echo "<h1 align='center'>You are now in the page of controller2</h1>";

$rc = new ReflectionClass("Controller2");
foreach ($funtionOptions as $function){
    if ($rc->hasMethod($function)) {
        Controller2::$function();
    }
}

class Controller2 {
    public static function f1() {
        echo "<h2 align='center'>f1() of controller2</h2>";
    }

    public static function f2() {
        echo "<h2 align='center'>f2() of controller2</h2>";
    }
}