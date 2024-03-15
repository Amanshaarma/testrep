<?php
session_start();

require_once '../phpLogin/dbh.ini.php';


if (!(isset($_SESSION["user_id"]))) 
{
    header('Location: ../login.html');
    exit;
}
$value = $_GET['key'];

$sql = "DELETE FROM property WHERE prop_id = :value";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':value',$value);
$stmt->execute();
header('location: ../property-list.php');
exit;