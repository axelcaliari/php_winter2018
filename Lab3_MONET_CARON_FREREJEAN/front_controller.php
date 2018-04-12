<?php

/*
 * This file should contain your front controller and basic routing mechanism
 * in order to call the appropriate controller contained in the 'include' folder.
 */


// THIS IS FOR CLI ONLY


echo "Please enter your controller: ".PHP_EOL;
$controller = stream_get_line(STDIN, 1024, PHP_EOL);

echo "Please enter your function: ".PHP_EOL;
$action = stream_get_line(STDIN, 1024, PHP_EOL);

include("include/".$controller.".php");

$action();



