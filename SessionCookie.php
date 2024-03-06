<?php

$cookiename = "User";
$cookievalue = "Raghav";
setcookie($cookiename,$cookievalue,time()+(86400*30),'/',"",true);
var_dump($_COOKIE);
if(!isset($_COOKIE["name"]))
{
    
}

if(count($_COOKIE) > 0){
    echo "cookie is enable";
}
else
{
    echo "cookie is not found";
}

?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookiename])) {
  echo "Cookie named '" . $cookiename . "' is not set!";
} else {
  echo "Cookie '" . $cookiename . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookiename];
}
$servername =   "localhost";
$username = "root";
$passwoard = "root";
$conn = mysqli_connect($username, $username, $passwoard);
$sql = "create database php";
mysqli_query($conn, $sql);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
echo "Connect sussesfulll";

?>

</body>
</html>