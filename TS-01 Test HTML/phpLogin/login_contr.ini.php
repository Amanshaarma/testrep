<?php

function valid_emial(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_register($result)
{
    if (!$result)
    {
        return true;
    }
    return false;
}

function password_check($pwd,$password)
{
    if(!password_verify($pwd,$password))
    {
        return true;
    }
    return false;
}