<?php


function is_input_empty(
    string $firstname,
    string $lastname,
    string $email,
    string $password,
    string $copypwd,
    string $phone,
    string $address
) {
    if (
        empty($firstname) || empty($lastname) || empty($email) || empty($password)
        || empty($copypwd) || empty($phone) || empty($address)
    ) {
        return true;
    } else {
        return false;
    }
}

function phonenumber($phone) 
{
    $len = strlen($phone);
    if($len > 10)
    {
        return true;
    }    
    return false;
}


function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_register(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    }
    return false;
}

function passward_check(string $password, string $copypwd)
{
    if ($password != $copypwd) {
        return true;
    }
    return false;
}

function create_user(object $pdo,string $firstname,string $lastname,string $email,
                    string $password,$image,string $phone, string $address
) {
    set_user($pdo,$firstname,$lastname,$email,$password,$image,$phone,$address);
}
