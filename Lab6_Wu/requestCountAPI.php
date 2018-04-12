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
$request = array(
    "GET count" => 0,
    "POST count" => 0,
    "PUT count" => 0,
    "PATCH count" => 0,
    "DELET count" => 0,
);

if(isset($_SERVER['REQUEST_METHOD'])) {

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': $request['GET count']++; $request["GET"] = $_GET; break;
        case 'POST': $request['POST count']++; $request["GET"] = $_POST; break;
        case 'PUT': $request['PUT count']++; $request["GET"] = $_PUT; break;
        case 'PATCH': $request['PATCH count']++; $request["GET"] = $_PATCH; break;
        case 'DELETE': $request['DELET count']++; $request["GET"] = $_DELETE; break;
    }

    echo json_encode($request);
}