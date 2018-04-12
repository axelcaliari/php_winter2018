<?php session_start(); ?>

<html>

	<head>
		<meta charset = "utf-8">
	</head>

	<body>

		<?php

			if((!empty ($_POST["user"])) && (!empty ($_POST["password"]))) {
			
				$user = $_POST["user"];
				$password = $_POST["password"];

            	if($user == "bob" && $password == "coucou") {

            		echo 'success';
					$_SESSION["user"] = $user;
					$_SESSION["password"] = $password;

					$htmlOut = "<h1>Bienvenue " . $_SESSION["user"] . "</h1>";
					echo $htmlOut;

				} else {
					echo 'fail';
					header("Location: localhost:8888/login_form.php");
				}

			}

		?>

	</body>

	<?php 
		session_destroy();
		session_unset();
	?>

</html>