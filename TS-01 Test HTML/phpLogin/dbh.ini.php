<?php


$dsn = "mysql:host=localhost;dbname=php";
$username = "root";
$passward = "root";

try {
    $pdo = new PDO($dsn, $username, $passward);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch (PDOException $e)
    {
        echo "Connection Fail".$e->getMessage();
    }
