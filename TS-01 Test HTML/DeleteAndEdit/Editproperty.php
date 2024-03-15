<?php
session_start();

require_once '../phpSignup/signup_contr.ini.php';
require_once '../phpLogin/dbh.ini.php';


if (!isset($_SESSION["user_id"])) {
    $url = '../login.html';
    header('Location: ' . $url);
    exit;
}
$user_id = null;
if(!empty($_GET["key"]))
{
    $user_id = $_GET["key"];
}
if($user_id)
{
    $_SESSION['prop_id']= $user_id;
}
else if(!$user_id)
{
    $user_id = $_SESSION['prop_id'];
}
function get_user($user_id)
{
    global $pdo;
    $query = "SELECT * FROM property WHERE prop_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
$result = get_user($user_id);
function exitFun()
{
    header('Location: ../property-list.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $propName = inputTrim($_POST['propName']);
    $propType = inputTrim($_POST['property-type']);
    $price = inputTrim($_POST['price']);
    $location = inputTrim($_POST['location']);
    $description = inputTrim($_POST['description']);
    $photo = null;
    if ($_FILES["file"]['name']) {
        $filename = $_FILES["file"]['name'];
        $photo = file_get_contents($_FILES["file"]["tmp_name"]);
    }
    function image()
    {
        global $filename;
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!isset($_FILES['file']['name']) && !($_FILES['file']['error'] == 0)) {
            exitFun();
        } else if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && !empty($imageFileType)
        ) {
            exitFun();
        }
    }

    image();
    fetchResult($pdo,  $user_id, $propName, $price, $propType, $location, $description, $photo);
    header('Location: ../property-list.php');
    exit;
}

function fetchResult($pdo, $prop_id, $propName, $price, $propType, $location, $description, $image)
{
    // Prepare SQL query
    $sql = "UPDATE property SET ";

    $fields = array();
    if (!empty($propName)) {
        $fields[] = "propName = :propName";
    }
    if (!empty($price)) {
        $fields[] = "price = :price";
    }
    if (!empty($propType)) {
        $fields[] = "propType = :propType";
    }
    if (!empty($location)) {
        $fields[] = "location = :location";
    }
    if (!empty($description)) {
        $fields[] = "description = :description";
    }
    if (!empty($image)) {
        $fields[] = "image = :image";
    }

    $sql .= implode(", ", $fields);
    $sql .= " WHERE prop_id = :prop_id";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    if (!empty($propName)) {
        $stmt->bindParam(':propName', $propName);
    }
    if (!empty($price)) {
        $stmt->bindParam(':price', $price);
    }
    if (!empty($propType)) {
        $stmt->bindParam(':propType', $propType);
    }
    if (!empty($location)) {
        $stmt->bindParam(':location', $location);
    }
    if (!empty($description)) {
        $stmt->bindParam(':description', $description);
    }
    if (!empty($image)) {
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    }

    // Bind prop_id
    $stmt->bindParam(':prop_id', $prop_id);

    // Execute the query
    $stmt->execute();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Codingkart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link href="../css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="../css/global_fonts_style.css" type="text/css" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link href="../css/responsive.css" type="text/css" rel="stylesheet">
</head>

<body>

    <section class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Codingkart Test</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="nav-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navs">
                        <ul>
                            <li><a href="Profile.php">Profile</a></li>
                            <li><a href="property.html">Add Property</a></li>
                            <li><a href="property-list.php" class="active">List Property</a></li>
                            <li><a href="search-page.html">Search Property</a></li>
                            <li><a href="phpLogin/logout.ini.php">Logout</a></li>
                        </ul>

                        <a href="#" class="mobile-icon"><i class="fa fa-bars" aria-hidden="true"></i></a>

                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="main-content paddnig80">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                   <div class="main-width">
                    <h2>Property Form</h2>
                   <form class="Property-form" method="post" action="Editproperty.php" enctype="multipart/form-data">
                       <div class="wd70">
                      <div class="form-field">
                        <label>Property Name*</label>
                          <input type="text" name="propName" value="<?php echo $result['propName']; ?>" placeholder="Enter Property Name">
                     </div>
                         <div class="form-field">
                        <label>Property Type*</label>
                          <select name="property-type" >
                              <option value="">None</option>  
                              <option value="Residential">Residential/Sell</option>  
                              <option value="Commercial">Commercial/Sell</option>     
                              <option value="Rental">Rental</option>   
                          </select>
                     </div>
                       </div>
                       
                       <div class="wd30">
                       <div class="upload-picture">
                         <div class="fileUpload">
                          <input type="file" name="file" class="upload" />
                          </div>
                           <label>Property Image</label>
                       </div>
                       </div>
                       
                         <div class="form-field">
                        <label>Property Price*</label>
                          <input type="number" name="price" value="<?php echo $result['price']; ?>" placeholder="Enter Property Price">
                     </div>
                         <div class="form-field">
                        <label>Property Location*</label>
                          <input type="text" name="location" value="<?php echo $result['location']; ?>" placeholder="Enter Location">
                     </div>
                         
                          
                         <div class="form-field">
                        <label>Property Description* </label>
                          <textarea name="description" placeholder="Enter Description"><?php echo $result['description']; ?></textarea>
                     </div>
                       
                        <div class="form-field">
                           <input type="submit" value="Submit"> 
                       </div>
                   </form>
                   </div>
                </div>
            </div>
        </div>
    </section>




    <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</body>

</html>