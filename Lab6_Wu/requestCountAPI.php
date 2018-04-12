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
if (!empty($_COOKIE["request"])) {
    $request = json_decode($_COOKIE["request"], true);

    if(isset($_SERVER['REQUEST_METHOD'])) {

        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                $request['GET count']++;
                $request["GET"] = $_GET;
                break;
            case 'POST':
                $request['POST count']++;
                $request["POST"] = $_POST;
                break;
            case 'PUT':
                $request['PUT count']++;
                $request["PUT"] = $_PUT;
                break;
            case 'PATCH':
                $request['PATCH count']++;
                $request["PATCH"] = $_PATCH;
                break;
            case 'DELETE':
                $request['DELETE count']++;
                $request["DELETE"] = $_DELETE;
                break;
        }
        $result = json_encode($request,JSON_PRETTY_PRINT);

        echo ($result);
    }
}

