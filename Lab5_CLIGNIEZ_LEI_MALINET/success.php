<?php
/**
 * Created by PhpStorm.
 * User: LEI_Siqi
 * Date: 11/04/2018
 * Time: 22:35
 */

    session_start();

    if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
        header("Location: index.php");
    }
?>

<h2>You have logged in!</h2>
