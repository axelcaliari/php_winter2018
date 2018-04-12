<?php

/*
 * Create a simple API that will count every HTTP request that is sent to it and return the
 * value in JSON format. Also, create a simple JS periodical updater function that will send
 * AJAX requests to it and display the result as a string in the Web page.
 */


$myfile = fopen("test.txt", "r") or die("Unable to open file!");
$requestCounter =  fread($myfile,filesize("test.txt"));
fclose($myfile);
$requestCounter++;
$myJSON = json_encode($requestCounter);
echo $myJSON;
$myfile = fopen("test.txt", "w") or die("Unable to open file!");
fwrite($myfile, $requestCounter);
fclose($myfile);


