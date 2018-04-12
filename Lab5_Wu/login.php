<?php
/**
 * Created by PhpStorm.
 * User: w_iahong
 * Date: 2018-04-10
 * Time: 3:59 PM
 */
session_start(); ?>

<html lang="en">
<head>
    <title>Lab5 Login Page</title>

</head>

<?php
    if(!isset($_SESSION['account']) || empty($_SESSION['account'])) { ?>
            <div style="margin: 0 auto; width: 450px; position: relative; top: 20%; border: #2aabd2 solid; padding: 20px;">
                <form action="checklogin.php" method="post">
                    <div class="form-group">
                        <label for="account">Account</label>
                        <input type="text" name="account" class="form-control" id="account" aria-describedby="emailHelp"
                               placeholder="Enter account">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        <?php
    }

    else if (isset($_SESSION['expire']) && $_SESSION['expire'] < time()) {
        echo "<script>alert(\"Your session is expired\")</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0.2;url=logout.php?expire\">";
    }

    else {
        $_SESSION['expire'] = time() + 10;
        ?>
        <div style="margin: 0 auto; width: 450px; position: relative; top: 20%; border: #2aabd2 solid; padding: 20px;">
            <form action="logout.php" method="post">
                <div class="form-group">
                    <label for="account">Hello, Mr &nbsp;</label><?=$_SESSION['account'];?>
<!--                    <input type="text" class="form-control" id="account" aria-describedby="emailHelp" placeholder="Enter account">-->
                </div>

                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>

        <?php
    }
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>
