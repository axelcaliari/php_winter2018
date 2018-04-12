<?php

/* table we use for checking the username and password :
	CREATE table lab5 (
		login varchar(20),
		mdp varchar(20),
	);
*/

ob_start();

$html = "<!DOCTYPE html>
		<html>
			<head>
				<meta charset=\"utf-8\">
			</head>
			<body>
				<form method=\"post\" action=\"lab5.php\">
					<label>Login : <input name=\"login\" autocomplete=\"off\"></input></label><br><br>
					<label>Password : <input name=\"mdp\" type=\"password\" autocomplete=\"off\"></input></label><br><br>
					<input type=\"submit\" name=\"submit\"></input>
				</form>
			</body>
		</html>";

echo $html;

if(isset($_POST['submit'])){	
    try{
        $link = new PDO('mysql:host=localhost;dbname=lab5', 'lightmvctestdb', 'testpass');

        /*
         * Sanitizing, filtering and validating the $_POST array would be important.
         * Storing the password in plain text is not a good idea.
         *
         */
        $query = "SELECT * from login WHERE login='" . $_POST['login'] . "' AND mdp='" . $_POST['mdp'] . "'";
        $reponse = $link->query($query);
        $row = $reponse->fetch();

        $mdp = $row["mdp"];

        if($mdp == $_POST["mdp"])
            echo "You are connected";

        else
            echo "Connexion failed";

    }catch(PDOException $e){
        echo $e->getMessage();
    }

}


ob_end_flush();

flush();

exit;
