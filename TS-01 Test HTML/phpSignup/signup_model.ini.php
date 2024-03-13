<?php


function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM sighup WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(
    object $pdo,
    string $firstname,
    string $lastname,
    string $email,
    string $password,
    $photo,
    string $phone,
    string $address
) {
    $firstname = inputTrim($firstname);
    $lastname = inputTrim($lastname); 
    $phone= inputTrim($phone);
    $address= inputTrim($address);



    $query = "INSERT INTO sighup(firstname,  lastname,  email, passward,
     phone,address,photo) VALUES ( :firstname,  :lastname,  :email,  :password,
      :phone, :address,:photo);";
    $stmt = $pdo->prepare($query);
    $option = [
        'cost' => 12
    ];
    $hashpwd = password_hash($password, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashpwd);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":photo",$photo,PDO::PARAM_LOB);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function inputTrim($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }
