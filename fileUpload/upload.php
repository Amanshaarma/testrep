<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dsn = "mysql:host=localhost;dbname=phplogin";
    $username = "root";
    $passward = "root";

    try {
        $pdo = new PDO($dsn, $username, $passward);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $filename = $_FILES["upload"]["name"];
        $filedata = file_get_contents( $_FILES["upload"]["tmp_name"]);

        $sql = "INSERT INTO files (filename,filedaa)VALUES(:filename,:filedata);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":filename",$filename);
        $stmt->bindParam(":filedata",$filedata,PDO::PARAM_LOB);
        $stmt->execute();
        echo "photo inserted into db";
    } catch (PDOException $e) {
        echo "Connection is falied " . $e->getMessage();
        exit;
    }
}
