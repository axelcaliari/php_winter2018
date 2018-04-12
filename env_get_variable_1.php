<html>
<head>
</head>
<body>
<p>The value of the 'user' index of your $_GET variable is :
    <?php if (isset($_GET['user'])) {
        $user = (string) $_GET['user'];
        $user = trim(strip_tags($user));
        echo ' ' . $user;
    } ?></p>
<p>Your $_GET variable is :<?php if (!empty($_GET)) { var_dump($_GET); } ?></p>

</body>
</html>
