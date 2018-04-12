
<!-- Create a simple login form that will authenticate and authorize a user.-->

<!DOCTYPE HTML>

<?php
session_start();

$username = "user";
$password = "password";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("php_winter2018 : success.php");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['logged_in'] = true;
        header ("Location:success.php");
    }
}
?>

<html>
    <body>
        <form methode= "post" action="index.php">
        Username:<br/>
        <input type="text" name ="username"><br/>
        Password<br/>
        <input type="password" name="password"><br/>
        <input type="submit" value="Login">
        </form>
    </body>
</html>