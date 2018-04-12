
<!-- Create a simple login form that will authenticate and authorize a user.-->

<!DOCTYPE HTML>

<?php
// When dealing with headers, you must always prevent Apache from sending them by buffering the output.
ob_start();
session_start();

$username = "user";
$password = "password";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: success.php");
} elseif (isset($_POST['username'])
    && isset($_POST['password'])
    && $_POST['username'] == $username
    && $_POST['password'] == $password
) {
    $_SESSION['logged_in'] = true;
    header("Location: success.php");
} else {
    $str = <<<'EOD'
<html>
    <body>
        <form method="post" action="index.php">
        Username:<br/>
        <input type="text" name ="username"><br/>
        Password<br/>
        <input type="password" name="password"><br/>
        <input type="submit" value="Login">
        </form>
    </body>
</html>
EOD;
    echo $str;
}

ob_flush();
flush();
