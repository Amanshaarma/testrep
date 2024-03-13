<?php




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo "signup php page";
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $copypwd = $_POST["copypawd"]; 
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    if($_FILES['file']['name'])
    {
        $image = file_get_contents( $_FILES['file']['tmp_name']);
    }

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.ini.php';
        require_once 'signup_contr.ini.php';

        // ERROR HANDLING

        $error = [];

        if (is_input_empty($firstname, $lastname, $email, $password, $copypwd, $phone, $address)) {
            $error['filed'] = "Fields are empty ";
        }
        if (is_email_invalid($email)) {
            $error['email'] = "invalid email ";
        }
        if(phonenumber($phone))
        {
            $error["phone"] = "incorrect phone number";
        }
        if (passward_check($password, $copypwd)) {
            $error['passaword_missmatch'] = "Both password are different";
        }
        if (is_email_register($pdo, $email)) {
            $error['registered'] = "Email already register";
        }

        function image()
        {
            if(!(isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0))
            {
                echo  "image is not valid";
                $error['image'] = "image is not valid";
            }
        }
        image();
        

        require_once 'config_Session.ini.php';
        if ($error) {
            $_SESSION["error_signup"] = $error;

            $url = "../signup.html";
            header('Location: ' . $url , true, 302);
            die();
        }

        create_user(
            $pdo,
            $firstname,
            $lastname,
            $email,
            $password,
            $image,
            $phone,
            $address
        );

        $url = "../login.html";
        header('Location: ' . $url."?signup=success", true, 302);
        $pdo = null;
        $stmt = null;
        exit;
    } catch (PDOException $err) {
        die("query failed" . $err->getMessage());
    }
} else {
    $url = "../signup.html";
    header('Location: ' . $url, true, 302);
    exit;
}
