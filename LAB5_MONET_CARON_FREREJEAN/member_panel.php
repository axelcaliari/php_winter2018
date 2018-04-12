<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php
session_start();
if (isset($_SESSION["user"])) {
    echo "Hello admin, you are connected !";
    ?>
    <br>
    <a class="btn btn-danger" href="disconnect.php" role="button">Disconnect</a>

    <?php
}
else {
    echo "member space, please connect first";
    echo "<br>";
    echo "<a class='btn btn-primary' href='index.php' role='button'>Connection</a>";
}



?>