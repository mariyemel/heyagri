<?php
// Start or resume the session
session_start();

// Destroy all session data
$_SESSION = array();

// If you want to completely destroy the session, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// Redirect to the login page or the home page after logout
header("Location: home.php");
exit;
