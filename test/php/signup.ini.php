<?php

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
   
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $filename = $_FILES['file']['name'];
    $filedata = file_get_contents( $_FILES['file']['tmp_name']);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $copypwdd = $_POST["copypawd"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    if(empty($filedata))
    {
        echo "image not found";
    }
    else
    {
        // echo $filedata;
        echo "image found ";
    }
    echo $firstname;
    echo $lastname;
    echo $copypwdd;
    echo $email;
    echo $password;
    echo $phone;
    echo $address;
}
else
{
    $url = "../signup.html";
    header('Location: ' . $url, true, 302);
    exit;
}

