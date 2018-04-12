<?php
session_start();
$error='';

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = stripslashes($username);
        $password = stripslashes($password);

        $str = file("mdp.txt");
        //echo 'allo';
        for($i=0; $i<count($str); $i++ ){
            $exploded_str = explode(" ", $str[$i]);
            if ($username == $exploded_str[0] && $password == $exploded_str[1]) {
                $_SESSION['login_user'] = $username;
                header("location: profile.php");
                break;
            } else {
                $error = "Username or Password is invalid";
                echo $error;
            }
        }


    }
}
