<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 2018/4/12
 * Time: 3:14
 *
 * Create a simple API that will count every HTTP request that is sent to it and return the
 * value in JSON format. Also, create a simple JS periodical updater function that will send
 * AJAX requests to it and display the result as a string in the Web page.
 *
 */
$file = dirname('.') . DIRECTORY_SEPARATOR . 'request_count.txt';

/* if the file doesn't exist yet, create it for the fist time */
if (!file_exists($file)) {
    $handle = fopen($file, "w+");
    $requestCount = array(
        "RequestCount" => 0,
        "RequestValue" => [],
    );
    fwrite($handle, json_encode($requestCount));
    fclose($handle);
}

if(isset($_SERVER['REQUEST_METHOD'])) {

    $requestCount = json_decode(file_get_contents($file), true);

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            $requestCount['RequestCount']++;
            $requestCount["RequestValue"] = $_GET;
            break;
        default :
            break;
    }
    $result = json_encode($requestCount, JSON_PRETTY_PRINT);
    file_put_contents($file, $result);
    echo ($result);
}

