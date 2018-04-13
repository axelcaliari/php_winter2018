<?php
/*
 * Create a simple API that will count every HTTP request that is sent to it and return the
 * value in JSON format. Also, create a simple JS periodical updater function that will send
 * AJAX requests to it and display the result as a string in the Web page.
 */

$counter = file_get_contents('counter.txt');
$counter += 1;
file_put_contents('counter.txt', $counter);

echo json_encode($counter);
