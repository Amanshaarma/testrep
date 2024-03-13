<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);


session_set_cookie_params([
    'lifetime' => 1000,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();


if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["last_regeneration"])) {
        create_session_login();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >=   $interval) {
            create_session_login();
        }
    }
} else {


    if (!isset($_SESSION["last_regeneration"])) {
        create_session();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >=   $interval) {
            create_session();
        }
    }
}
function create_session()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}
function create_session_login()
{
    $userId = $_SESSION["user_id"];
    session_regenerate_id(true);
    $newSession = session_create_id();
    $sessionId = $newSession . " " . $userId;
    session_id($sessionId);
    $_SESSION["last_regeneration"] = time();
}
