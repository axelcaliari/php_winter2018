<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: member_panel.php");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validation($_POST['username']);
    $password = validation($_POST['password']);

    if ($username == "admin" && $password == "admin")
    {
        $_SESSION["user"] = "admin";
        header("Location: member_panel.php");
    }
}


function validation ($string) {
    // string input validation
    $cleaned = (string) $string;
    $cleaned = trim($cleaned);
    $cleaned = htmlspecialchars($cleaned);
    $cleaned = strip_tags($cleaned);
    return $cleaned;
}

?>




<style media="screen" type="text/css">
@import url(http://fonts.googleapis.com/css?family=Roboto:400);
body {
background-color:#fff;
-webkit-font-smoothing: antialiased;
font: normal 14px Roboto,arial,sans-serif;
}

.container {
padding: 25px;
position: fixed;
}

.form-login {
background-color: #EDEDED;
padding-top: 10px;
padding-bottom: 20px;
padding-left: 20px;
padding-right: 20px;
border-radius: 15px;
border-color:#d2d2d2;
border-width: 5px;
box-shadow:0 1px 0 #cfcfcf;
}

h4 {
border:0 solid #fff;
border-bottom-width:1px;
padding-bottom:10px;
text-align: center;
}

.form-control {
border-radius: 10px;
}

.wrapper {
text-align: center;
}
</style>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>

        </div>
    </div>
</div>