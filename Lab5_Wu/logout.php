<?php
/**
 * Created by PhpStorm.
 * User: w_iahong
 * Date: 2018-04-10
 * Time: 4:26 PM
 */

session_start();
session_unset();
session_destroy();
if(!isset($_GET["expire"])) {
    echo "<script>alert(\"You've logged out\")</script>";
}
?>
<meta http-equiv="refresh" content="0.2;url=login.php">
