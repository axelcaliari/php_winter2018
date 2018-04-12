<?php
/**
 * Created by PhpStorm.
 * User: w_iahong
 * Date: 2018-04-10
 * Time: 4:36 PM
 */
session_start();
if (isset($_POST['account'])
    && isset($_POST['password'])
    && !empty($_POST['account'])
    && !empty($_POST['password'])) {

    $user = parse_ini_file("user.ini");
    (string) $account = $_POST['account'];
    (string) $password = md5($_POST['password']);

    if($account == $user['account'] && $password == $user['password']) {
        echo "<script>alert(\"Login with success!\")</script>";
        $_SESSION["account"] = $account;
        $_SESSION['expire'] = time() + 10;
    }
}
?>
<meta http-equiv="refresh" content="0.2;url=login.php">