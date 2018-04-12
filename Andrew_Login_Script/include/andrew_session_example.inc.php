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

function session_obliterate()
{
    
    $_SESSION = array();
    setcookie(session_name(),'', time() - 3600, '/');
    setcookie('loggedin', '', time() - 3600, '/');
    session_destroy();   // Destroy session data in storage.
    session_unset();     // Unset $_SESSION variable for the runtime.
    $validSession = FALSE;
    return $validSession;
    
}

function session_secure_init()
{
    session_set_cookie_params(4200);

    $validSession = TRUE;
    
    if (!defined('OURUNIQUEKEY')) {
    
        define('OURUNIQUEKEY', 'phpi');
    
    }
    
    // Avoid session prediction.
    $sessionname = OURUNIQUEKEY;
    
    if (session_name() != $sessionname) {
    
        session_name($sessionname);
    
    } else {
    
        session_name();
    
    }
    
    // Start session.
    session_start();
    
    if ((!isset($_COOKIE['loggedin']) && isset($_SESSION['LOGGEDIN']))
        ^ (isset($_COOKIE['loggedin']) && !isset($_SESSION['LOGGEDIN']))) {
    
        $validSession = FALSE;
    
    }
    
    if ($validSession == TRUE) {
        
        // Avoid session fixation.
        if (!isset($_SESSION['INITIATED'])) {
        
            session_regenerate_id();
            $_SESSION['INITIATED'] = TRUE;
        
        }
        
        if (!isset($_SESSION['CREATED'])) {
        
            $_SESSION['CREATED'] = time();
        
        } 
        
        if (time() - $_SESSION['CREATED'] > 3600) {
        
            // Session started more than 60 minutes ago.
            session_regenerate_id();    // Change session ID for the current session an invalidate old session ID.
            $_SESSION['CREATED'] = time();  // Update creation time.
        
        }
        
        // Avoid session hijacking.
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        
        $useragent .= OURUNIQUEKEY;
        
        if (isset($_SESSION['HTTP_USER_AGENT'])) {
        
            if ($_SESSION['HTTP_USER_AGENT'] != md5($useragent)) {
        
                $validSession = FALSE;
        
            }
        
        } else {
        
            $_SESSION['HTTP_USER_AGENT'] = md5($useragent);
        
        }
        
        // Avoid session fixation in case of an inactive session.
        if ($validSession == TRUE && isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > 3600) {
            
            // Last request was more than 60 minutes ago.
            $validSession = FALSE;
            
        } else {
        
            $_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp.
        
        }
    
    }
    
    return $validSession;

}
