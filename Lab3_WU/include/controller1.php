<?php

// This file should contain your first controller.

echo "<h1 align='center'>You are now in the page of controller1</h1>";

$rc = new ReflectionClass("Controller1");
foreach ($funtionOptions as $function){
    if ($rc->hasMethod($function)) {
        Controller1::$function();
    }
}

class Controller1 {
    public static function f1() {
        echo "<h2 align='center'>f1() of controller1</h2>";
    }

    public static function f2() {
        echo "<h2 align='center'>f2() of controller1</h2>";
    }
}
