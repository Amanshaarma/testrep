<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    
    try
    {
        require_once 'dbh.ini.php';
        require_once 'login_model.ini.php';
        require_once 'login_contr.ini.php';
        
        // ERROR HANDLING   
        
        $error = [];
        
        if(valid_emial($email))
        {
            $error['email'] = "Invalid email";
        }
        $result = get_email($pdo,$email);
        
        if(is_email_register($result))
        {
            $error["register"] = "Email not register";
        }
        if(password_check($password,$result["passward"]))
        {
            $error["password"] = "Password is incorrect";
        }
        
        require_once '../phpSignup/config_Session.ini.php';
        

        if($error)
        {
            $_SESSION["login_error"] = $error;
            
            $url = "../login.html";
            header('Location: ' . $url, true, 302);
            exit;
        }
        $newSession = session_create_id();
        $sessionId = $newSession . " ".$result["id"];
        session_id($sessionId);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_name"] = $result["firstname"]." ".$result["lastname"];
        
        
        $_SESSION["last_regeneration "] = time();
        $url = "../property-list.php";
        header('Location: ' . $url);
        exit;
        $pdo = null;
        $stmt = null;
        die();
        
    }
    catch(PDOException $e)
    {
        echo "query failed ".$e->getMessage();
        exit;
    }


}
else
{
    $url = "../login.html";
    header('Location: ' . $url, true, 302);
    exit;
}