<?php
/**
 * Andrew's Session App
 *
 * @package    Andrew's Session App
 * @author     Andrew Caya
 * @link       https://github.com/andrewscaya
 * @version    2.1.0
 * @license    http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */

// Start output buffering.
ob_start();

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'andrew_mysql_example.inc.php';

require_once dirname(__FILE__)
    . DIRECTORY_SEPARATOR
    . 'include'
    . DIRECTORY_SEPARATOR
    . 'andrew_session_example.inc.php';

// Set flags.
$loginCheck = FALSE;

$validSession = FALSE;

$postLoginForm = TRUE;

// Initialize application business and frontend messages.
$errorMessage = 0;

$userMessage = '';

// Check if user is already logged in.
if (isset($_COOKIE['loggedin'])) {
        
    if ($validSession === FALSE) {
    
        $validSession = session_secure_init();
    
    }
    
    //  Check for cookie tampering.
    if ($validSession === TRUE && isset($_SESSION['LOGGEDIN'])) {
    
        $postLoginForm = FALSE;
    
    } else {
         
        $validSession = session_obliterate();
         
        $errorMessage = 3;
         
        $postLoginForm = TRUE;
         
    }
    
    // Cookie login check done.
    $loginCheck = TRUE;
    
}

// Login verification.
if (isset($_POST['submit'])
    && $_POST['submit'] == 1
    && !empty($_POST['username'])
    && !empty($_POST['password'])) {
    
    if ($validSession === FALSE) {
    
        $validSession = session_secure_init();
    
    }
    
    $username = (string) $_POST['username'];
    
    $password = (string) $_POST['password'];
    
    if (!ctype_alpha($username)) {
    
        $username = preg_replace("/[^a-zA-Z]+/", "", $username);
    
    }
    
    if (strlen($username) > 40) {
        
        $username = substr($username, 0, 39);
        
    }
    
    $password = preg_replace("/[^_a-zA-Z0-9]+/", "", $password);
    
    if (strlen($password) > 40) {
    
        $password = substr($password, 0, 39);
    
    }

    // Check credentials.
    if (checkLogin($username, $password)) {
        
        if ($validSession === TRUE) {
		    
            //  Check for cookie tampering.
            if (isset($_SESSION['LOGGEDIN'])) {
		        
                $validSession = session_obliterate();
                $errorMessage = 3;
                $postLoginForm = TRUE;
		    
            } else {
		
                setcookie('loggedin', TRUE, time()+ 4200, '/');
                $_SESSION['LOGGEDIN'] = TRUE;
                $_SESSION['REMOTE_USER'] = $username;
                $postLoginForm = FALSE;
            
            }
		
        } else {
		    
            $validSession = session_obliterate();
            $errorMessage = 3;
            $postLoginForm = TRUE;
		    
        }
		
    } else {
		
        $validSession = session_obliterate();
        $errorMessage = 1;
        $postLoginForm = TRUE;
		
    }
	
    // Username-password login check done.
    $loginCheck = TRUE;
    
}

// Intercept logout POST.
if (isset($_POST['logout'])) {
			
    if ($validSession === FALSE) {
        
        session_secure_init();
        
    }
    
    $validSession = session_obliterate();
    $errorMessage = 2;
    $postLoginForm = TRUE;

}

// Intercept invalid sessions and redirect to login page.
if ($loginCheck === TRUE && $validSession === FALSE && $errorMessage === 0) {
    
    if ($validSession === FALSE) {
    
        $validSession = session_secure_init();
        $validSession = session_obliterate();
    
    }
    
    $errorMessage = 3;
    $postLoginForm = TRUE;
    
}

// Prepare view output.
if ($postLoginForm === TRUE) {
    
    switch ($errorMessage) {
        
        case 0:
            $userMessage = 'Please sign in.';
            break;
        case 1:
            $userMessage = 'Wrong credentials.  <a href="index.php">Try again</a>.';
            break;
        case 2:
            $userMessage = 'You are logged out!  <a href="index.php">You can login again</a>.';
            break;
        case 3:
            $userMessage = 'Invalid session. <a href="index.php">Please login again</a>.';
            break;
    
    }

    $htmlOut = "<!DOCTYPE html>\n\n";
    $htmlOut .= "<html lang=\"en\">\n\n";
    $htmlOut .= "<head>\n\n";
    $htmlOut .= "\t<meta charset=\"utf-8\">\n";
    $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
    $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
    $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
    $htmlOut .= "\t<title>Login App</title>\n\n";
    $htmlOut .= "\t<!-- Bootstrap -->\n";
    $htmlOut .= "\t<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n\n";
    $htmlOut .= "\t<!-- Custom styles for this template -->\n";
    $htmlOut .= "\t<link href=\"css/signin.css\" rel=\"stylesheet\">\n\n";
    $htmlOut .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
    $htmlOut .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
    $htmlOut .= "\t<!--[if lt IE 9]>\n";
    $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
    $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
    $htmlOut .= "\t<![endif]-->\n\n";
    $htmlOut .= "</head>\n\n";
    $htmlOut .= "<body>\n\n";

    if ($errorMessage === 0) {

        $htmlOut .= "\t<div class=\"container\">\n";
    	$htmlOut .= "\t\t<form class=\"form-signin\" action=\"index.php\" method=\"post\" data-toggle=\"validator\" role=\"form\">\n";
    	$htmlOut .= "\t\t\t<h2 class=\"form-signin-heading\">" . $userMessage . "</h2>\n";
    	$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
    	$htmlOut .= "\t\t\t\t<label for=\"inputUsername\" class=\"control-label\">Username:</label>\n";
    	$htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputUsername\" name=\"username\" placeholder=\"Username\" type=\"text\" pattern=\"^[a-zA-Z]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required autofocus>\n";
    	$htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
    	$htmlOut .= "\t\t\t</div>\n";
    	$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
    	$htmlOut .= "\t\t\t\t<label for=\"inputPassword\" class=\"control-label\">Password:</label>\n";
    	$htmlOut .= "\t\t\t\t<input class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Password\" type=\"password\" pattern=\"^[_a-zA-Z0-9]+$\" maxlength=\"40\" data-error=\"Invalid character.\" required>\n";
    	$htmlOut .= "\t\t\t\t<div class=\"help-block with-errors\"></div>\n";
    	$htmlOut .= "\t\t\t</div>\n";
    	$htmlOut .= "\t\t\t<div class=\"form-group\">\n";
    	$htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"submit\" type=\"submit\" value=\"1\">Submit</button>\n";
    	$htmlOut .= "\t\t\t</div>\n";
    	$htmlOut .= "\t\t</form>\n";
    	$htmlOut .= "\t</div> <!-- /container -->\n\n";

    } else {

        $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
        $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
        $htmlOut .= "\t\t<div class=\"jumbotron\">\n";
        $htmlOut .= "\t\t\t<h2>" . $userMessage . "</h2>\n";
        $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
        $htmlOut .= "\t</div> <!-- /container -->\n\n";

    }
	
    $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
    $htmlOut .= "\t<script src=\"js/jquery.min.js\"></script>\n";
    $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
    $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
    $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
    $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n";
    $htmlOut .= "\t<!-- Form validator for Bootstrap 3 -->\n";
    $htmlOut .= "\t<script src=\"js/validator.min.js\"></script>\n\n";
    $htmlOut .= "</body>\n\n";
    $htmlOut .= "</html>";

} else {

    $htmlOut = "<!DOCTYPE html>\n\n";
    $htmlOut .= "<html lang=\"en\">\n\n";
    $htmlOut .= "<head>\n\n";
    $htmlOut .= "\t<meta charset=\"utf-8\">\n";
    $htmlOut .= "\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
    $htmlOut .= "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
    $htmlOut .= "\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\n\n";
    $htmlOut .= "\t<title>Login App</title>\n\n";
    $htmlOut .= "\t<!-- Bootstrap -->\n";
    $htmlOut .= "\t<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n\n";
    $htmlOut .= "\t<!-- Custom styles for this template -->\n";
    $htmlOut .= "\t<link href=\"css/signin.css\" rel=\"stylesheet\">\n\n";
    $htmlOut .= "\t<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n";
    $htmlOut .= "\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n\n";
    $htmlOut .= "\t<!--[if lt IE 9]>\n";
    $htmlOut .= "\t\t<script src=\"js/html5shiv.min.js\"></script>\n";
    $htmlOut .= "\t\t<script src=\"js/respond.min.js\"></script>\n";
    $htmlOut .= "\t<![endif]-->\n\n";
    $htmlOut .= "\t<style media=\"screen\" type=\"text/css\">\n\n";
    $htmlOut .= "\t\t.container {\n";
    $htmlOut .= "\t\t\tmax-width: 480px;\n";
    $htmlOut .= "\t\t}\n\n";
    $htmlOut .= "\t</style>\n\n";
    $htmlOut .= "</head>\n\n";
    $htmlOut .= "<body>\n\n";
    $htmlOut .= "\t<div class=\"container theme-showcase\" role=\"main\">\n";
    $htmlOut .= "\t\t<!-- Main jumbotron for a primary marketing message or call to action -->\n";
    $htmlOut .= "\t\t<div class=\"jumbotron\">\n";
	
    if (isset($_GET["check"])) {
	    
        $htmlOut .= "\t\t\t<h2>Hello, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are still logged in.<br /><br /><br /><br /></h2>\n";
	    
    } else {
	    
        $htmlOut .= "\t\t\t<h2>Welcome, " . $_SESSION['REMOTE_USER'] . "!<br /><br /><br />You are logged in.</h2><br /><br /><p><a href=\"index.php?check=1\">Check cookie</a><br /><br /><br /><br /></p>\n";
    }
	
    $htmlOut .= "\t\t\t<form action=\"index.php\" method=\"post\">\n";
    $htmlOut .= "\t\t\t\t<button class=\"btn btn-lg btn-primary btn-block\" name=\"logout\" type=\"submit\" value=\"2\">Logout</button>\n";
    $htmlOut .= "\t\t\t</form>\n";
    $htmlOut .= "\t\t</div> <!-- /jumbotron -->\n";
    $htmlOut .= "\t</div> <!-- /container -->\n\n";
    $htmlOut .= "\t<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->\n";
    $htmlOut .= "\t<script src= \"js/jquery.min.js\"></script>\n";
    $htmlOut .= "\t<!-- Include all compiled plugins (below), or include individual files as needed -->\n";
    $htmlOut .= "\t<script src=\"js/bootstrap.min.js\"></script>\n";
    $htmlOut .= "\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->\n";
    $htmlOut .= "\t<script src=\"js/ie10-viewport-bug-workaround.js\"></script>\n\n";    
    $htmlOut .= "</body>\n\n";
    $htmlOut .= "</html>";

}

// Render and then send the response to the client by flushing the buffer.
echo $htmlOut;

ob_end_flush();

flush();

exit;
