<?php

$dbh = "mysql:host=localhost;dbname=php";
$username = "root";
$password = "root";

try {
    $pdo = new PDO($dbh,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) 
{
  echo "failed connection ".$e->getMessage();
}

