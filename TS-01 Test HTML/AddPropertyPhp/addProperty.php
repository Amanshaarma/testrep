<?php
session_start();
    if(!isset($_SESSION["user_id"]))
    {
        header('Location: ../login.html');
        die();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $propName = $_POST["propName"];
        $price = $_POST["price"];
        $propType = $_POST["property-type"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $signup_id = $_SESSION["user_id"];
        if ($_FILES["file"]['name']) {
            $filename = $_FILES["file"]['name'];
            $image = file_get_contents($_FILES["file"]["tmp_name"]);
        }
        try
        {
            require_once 'addprop_contr.php';
            require_once 'prop_model.php';
            require_once 'dbh.php';

            # Error handling
            $error = [];
            if (is_input_empty($propName,$price,$propType,$location,$description))
            {
                $error['fields'] = "Fields are empty";
            }
            function image()
            {
                global $filename;
                $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                
                if(!isset($_FILES['file']['name']) && !($_FILES['file']['error'] == 0))
                {
                    global $error;
                    $error['file'] = "image is not valid";
                }
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif")
                {
                    $error['file'] = "image is not valid";
                }
            }
            image();

            
            if($error)
            {
                $_SESSION["propError"] = $error;
                
                header('location: ../property.html');
                die();
            }
        
            create_property($pdo,$propName,$price,$propType,$location,$description,$image,$signup_id);

            header('Location: ../property-list.php');
            $pdo = null;
            $stmt = null;
            die();
        }
        catch(PDOException $e)
        {
            echo "query not exceuted ".$e->getMessage();
            // header('Location: ../property.html');
            die();
        }
    }
    else
    {
        header('Location: ../property.html');
    }