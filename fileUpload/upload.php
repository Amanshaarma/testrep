<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dsn = "mysql:host=localhost;dbname=phplogin";
    $username = "root";
    $passward = "root";

    try {
        $pdo = new PDO($dsn, $username, $passward);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $filename = $_FILES["upload"]["name"];
        $filedata = file_get_contents($_FILES["upload"]["tmp_name"]);

        $sql = "INSERT INTO files (filename,filedaa)VALUES(:filename,:filedata);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":filename", $filename);
        $stmt->bindParam(":filedata", $filedata, PDO::PARAM_LOB);
        $stmt->execute();
        echo "photo inserted into db";
        $query = "SELECT * FROM files;";
        $stmt = $pdo->prepare($query);
        // $stmt->bindParam(":email", $email);
        $stmt->execute();
        echo "<table>";
        
        echo "<tr>";

        while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<td>";
            // echo print_r($result);
            echo '<img src="data:image;base64,' . base64_encode($result['filedaa']) . '" height="100px" alt="Image">';

            // echo '<img src="$result[\'filedaa\']" with="100px"';
            echo "</td>";
        }
        
        echo "</table>";
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // $image = $result["filedaa"];

        // header("Content-type: image/jpeg");
        // echo $image;
    } catch (PDOException $e) {
        echo "Connection is falied " . $e->getMessage();
        exit;
    }
}
