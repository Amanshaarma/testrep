<?php
    

// if($_SERVER["REQUEST_METHOD"] == "POST")
// {
//     $fileFolder = "images/";
//     // print_r($_FILES["upload"]);
//     $filename = $_FILES["upload"]["name"];
//     $tempname = $_FILES["upload"]["tmp_name"];
//     $size = $_FILES["upload"]["size"];
//     $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
//     //echo $size;
//     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//     && $imageFileType != "gif")
//     {
//         //echo "the file is not in the format";
//     }

//     if($size < 500000)
//     {
       
//         //echo "File is greater in size";
//         echo " <script>
//         setTimeout(fh,5000);
//         alert('redirecting');
//         function fh ()
//         {
//             window.location.href = '../fileUpload/fileupload.html';
//         }
//        </script>";
//     //    header('Location: ../fileUpload/fileupload.html');
//        exit();

//     }
//     if (file_exists($fileFolder)) {
//         //echo "Sorry, file already exists.";
//       }
//     $fileFolder = $fileFolder.$filename;
//     // //echo $fileFolder;
//     move_uploaded_file($tempname,$fileFolder);
//     // header('Location: ../fileUpload/fileupload.html');
//     // header("location : fileupload.html");
   
//}


$dsn = "mysql:host=localhost;dbname=phplogin";
    $username = "root";
    $passward = "root";

    try {
        $pdo = new PDO($dsn, $username, $passward);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM files;";
        $stmt = $pdo->prepare($query);
        // $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $result["filedaa"];
        $image = base64_encode($image);
        header("Content-type: image/jpeg");
        echo $image;
    } catch (PDOException $e) {
        echo "Connection is falied " . $e->getMessage();
        exit;
    }

function divide ($divident,$divisor)
{
    if($divisor === 0)
    {
        return new Exception("Divide by zero",2);
    }
    return $divident / $divisor;
}


try {
    echo divide(5,0);
} catch (\Throwable $th) 
{
    //throw $th;
    $th->getFile();
}
finally
{
    echo date("h:i:sa");
    echo time();
    echo "Process is completer";
}
?>