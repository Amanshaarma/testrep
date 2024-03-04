<?php
$cookiename = "User";
$cookievalue = "Aman";
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
?>

</body>
</html>