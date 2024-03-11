    <?php
    include_once "Day2.php";
    // echo ($_REQUEST['subject']." with ".$_REQUEST['web']);
    //     echo $_REQUEST["subject"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // echo  inputTrim( $_SERVER['PHP_SELF'])."<br>";
        $nameError = "";
        $passwardErr = "";
        $commentErr = "";
        $genderErr = "";
        $name =  "";
        $passward = "";
        $comment ="";
        $gender =  "";

        if(empty($_POST["username"] ))
        {
            $nameError ="Name is required";
        }
        else{
            $name = inputTrim($_POST["username"] );
            // if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            //     $nameError = "Only letters and white space allowed";
            //   }
            if(!filter_var($name,FILTER_VALIDATE_EMAIL))
            {
                $nameError = "invalid Email format";
            }
        }

        if(empty( $_POST["passward"]))
        {
            $passwardErr = "Passward is Required";
        }
        else
        {
            if(passwardValidater($_POST["passward"] ))
            {
                $passward = passwardEncreption($_POST["passward"]);
            }
            else
            {
                $passwardErr = "Passward required of lenght 8 And passward contains 1 special characteres";
            }
        }
        if(empty($_POST["gender"]))
        {
            $genderErr = "Gender is required";
        }
        else
        {
            $gender = inputTrim($_POST["gender"] );
        }
        if(!empty( $_POST["comment"]))
        {
            $comment = inputTrim( $_POST["comment"]);
        }
        echo $name. "<br>";
        echo  $passward. "<br>";
        echo $gender . "<br>";
        echo $comment."<br>";
        echo $commentErr. "<br>";
        echo $nameError. "<br>";
        echo $passwardErr. "<br>";
        echo $text;
        // echo  . "<br>";
       /* echo $_SERVER['SERVER_NAME'] . "<br>";
        echo $_SERVER['SERVER_SOFTWARE'] . "<br>";
        echo $_SERVER['SERVER_PROTOCOL'] . "<br>";
         echo $_SERVER['REQUEST_TIME'] . "<br>";*/
    }
    function inputTrim($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }
    function passwardValidater($data)
    {
        $length = strlen($data);
        if($length < 8)
        {
            return false;
        }
        $patter = '/(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[a-zA-Z0-9]).{8,}$/';
        if(preg_match($patter,$data))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    function passwardEncreption($passward)  
    {
        $hash = password_hash($passward,PASSWORD_DEFAULT);
        return $hash;
    }
    
    ?>