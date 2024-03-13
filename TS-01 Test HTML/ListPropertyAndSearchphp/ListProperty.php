<?php
session_start();

require_once 'dbh.ini.php';

if(!isset($_SESSION["user_id"]))
{
    $url = 'login.html';
    header('Location: '.$url);
    exit;
}
$user_id = $_SESSION["user_id"];
$result = allProperty();
function allProperty()
{
    global $user_id;
    global $pdo;
    $query = "SELECT * FROM property WHERE signup_id = $user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return  $result;
}



