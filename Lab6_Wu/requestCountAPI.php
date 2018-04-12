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
$requestCount = array(
    "GET count" => 0,
    "POST count" => 0,
    "PUT count" => 0,
    "PATCH count" => 0,
    "DELET count" => 0,
);

if(isset($_SERVER['REQUEST_METHOD'])) {

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': $requestCount['GET count']++; break;
        case 'POST': $requestCount['POST count']++; break;
        case 'PUT': $requestCount['PUT count']++; break;
        case 'PATCH': $requestCount['PATCH count']++; break;
        case 'DELET': $requestCount['DELET count']++; break;
    }

    echo json_encode($requestCount);
}