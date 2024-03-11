<?php
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

$dsn = "mysql:host=localhost;dbname=php";
$username = "root";
$passward = "root";

try {
    $pdo = new PDO($dsn, $username, $passward);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = "CREATE TABLE IF NOT EXISTS sighup
    //         (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    //         firstname VARCHAR(30) NOT NULL,
    //         lastname VARCHAR(30) NOT NULL,
    //         email VARCHAR(50) NOT NULL,
    //         passward VARCHAR(70) NOT NULL,
    //         phone INT(10),
    //         address VARCHAR(50),
    //         photo MEDIUMBLOB             
    //         )";
    //         $pdo->exec($sql);
    $sql = "INSERT INTO sighup (firstname,lastname,email,password,phone,address,photo)VALUES(?,?,?,?,?,?,?);";
    $stmt = $pdo->prepare($sql);
    // $stmt->bindParam() 
    // $stmt->execute([$use]);


    echo "Table created sucessfully :)";
} catch (PDOException $e) {
    echo "Connection is falied " . $e->getMessage();
    exit;
}


// $servername =   "localhost";  
// $username = "root";
// $passwoard = "root";

// $conn = mysqli_connect($servername, $username, $passwoard);
// $sql = "create database IF NOT EXISTS php";
// mysqli_query($conn, $sql);
// if (mysqli_connect_errno()) {
//     // If there is an error with the connection, stop the script and display the error.
//     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
// }
// echo "Connect sussesfulll";
