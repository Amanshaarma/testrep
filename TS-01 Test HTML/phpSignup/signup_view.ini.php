<?php

declare(strict_types=1);

function chech_signup_error()
{
    if(isset($_SESSION["error_signup"]))
    {
        $error = $_SESSION["error_signup"];

        echo "<br>";
        foreach($error as $er)
        {
            echo $er;
        }
        unset($_SESSION["error_signup"]);
    }
    elseif(isset($_GET['sighup']) && $_GET['sighup'] == 'success')
    {
        echo "";
    }
}


