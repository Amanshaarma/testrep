<?php
// phpinfo();
// $dsn = "mysql:host=localhost;dbname=test";
// $username = "root";
// $passward = "root";

// try {
//     $pdo = new PDO($dsn,$username,$passward);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) 
// {
//     echo "Connection is falied ".$e->getMessage();
// }

$servername =   "localhost";
$username = "root";
$passwoard = "root";
$conn = mysqli_connect($username, $username, $passwoard);
$sql = "create database php";
mysqli_query($conn, $sql);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
echo "Connect sussesfulll";
