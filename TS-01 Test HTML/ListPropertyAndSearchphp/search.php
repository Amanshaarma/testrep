<?php


require_once '../phpSignup/config_Session.ini.php';
if(!isset($_SESSION['user_id']))
{
    header('Location: ../login.html');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $propName = $_POST['propName'];
    $proptype = $_POST['proptype'];
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
    $location = $_POST['location'];
    
    // echo $propName;
    // echo $proptype;
    // echo $minPrice;
    // echo $maxPrice;
    // echo $location;
    require_once 'searc_contr.php';
    require_once 'dbh.ini.php';
    require_once 'search_model.php';

    $emptyValue = [];
    if(isNotNull($propName))
    {
        $emptyValue[0] = "value is not found";
    }
    if(isNotNull($proptype))
    {
        $emptyValue[1] = "value is not found";
    }
    if(isNotNull($minPrice))
    {
        $emptyValue[2] = "value is not found";
    }
    if(isNotNull($maxPrice))
    {
        $emptyValue[3] = "value is not found";
    }
    if(isNotNull($location))
    {
        $emptyValue[4] = "value is not found";
    }
    if(checkMaxMin($maxPrice,$minPrice))
    {
        $emptyValue[5] = "max and min is not compartable";
    }
    


    if($emptyValue)
    {
        header('Location: ../search-page.html');
        $emptyValue = null;
        exit;
    }

    # query work here

    $searchResult = getResult($pdo,$propName,$proptype,$minPrice,$maxPrice,$location);
    if($searchResult)
    {
        $_SESSION['serachResult'] = $searchResult;
        header('Location: ../property-list.php');
        exit;
    }
    header('Location: ../search-page.html');
    exit;

}
else
{
    header('Location: ../login.html');
    exit;
}