<?php

session_start();

if(isset($_POST['submit']))
{
    $username = (string) $_POST['username'];
    $password = (string) $_POST['password'];

    if (!ctype_alpha($username))
    {
        $username = preg_replace("/[^a-zA-Z]+/", "", $username);
    }

    $password = preg_replace("/[^_a-zA-Z0-9]+/", "", $password);


    if($username == "user" && $password == "passwd")
    {
        echo "Logged in successfully.";
    }else
    {
        echo "Wrong credentials. </br>";
        echo "<a href='login.html'>Try again...</a>";
    }
}else
{
    echo "No form submitted";
}

session_destroy();
session_unset();
