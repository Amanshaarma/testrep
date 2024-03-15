<?php
session_start();

require_once 'phpSignup/signup_contr.ini.php';
require_once 'phpLogin/dbh.ini.php';


if (!isset($_SESSION["user_id"])) {
    $url = 'login.html';
    header('Location: ' . $url);
    exit;
}
$user_id = $_SESSION["user_id"];
function get_user($user_id)
{
    global $pdo;
    $query = "SELECT * FROM sighup WHERE id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
$result = get_user($user_id);
function exitFun()
{
    header('Location: Profile.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = inputTrim($_POST['firstname']);
    $lastname = inputTrim($_POST['lastname']);
    $email = is_email_invalid($_POST['email']);
    if ($email) {
        exitFun();
    }
    $email = $_POST['email'];
    $copypawd = $_POST['copypawd'];
    $passward = $_POST['passward'];
    $phone = (string) phonenumber($_POST['phone']) ? exitfun() : $_POST['phone'];
    $address = inputTrim($_POST['address']);
    $photo = null;
    if ($_FILES["photo"]['name']) {
        $filename = $_FILES["photo"]['name'];
        $photo = file_get_contents($_FILES["photo"]["tmp_name"]);
    }
    if (empty($copypawd) && empty($passward) && $copypawd != $passward) {
        exitFun();
    }
    function image()
    {
        global $filename;
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!isset($_FILES['photo']['name']) && !($_FILES['photo']['error'] == 0)) {
            exitFun();
        } else if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && !empty($imageFileType)
        ) {
            exitFun();
        }
    }

    image();
    $key = fetchResult($pdo, $firstname, $lastname, $email, $passward, $phone, $address, $photo);
    header('Location: Profile.php');
    exit;
}

function fetchResult($pdo, $firstname, $lastname, $email, $password, $phone, $address, $image)
{
    global $user_id;

    // Check if image is provided
    if (!empty($image)) {
        // Update image
        $sql = "UPDATE sighup 
                SET photo = :photo
                WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':photo', $image, PDO::PARAM_LOB);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    // Update user information if provided
    if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($password) || !empty($phone) || !empty($address)) {
        // Prepare SQL query
        $sql = "UPDATE sighup 
                SET ";

        $fields = array();
        if (!empty($firstname)) {
            $fields[] = "firstname = :firstname";
        }
        if (!empty($lastname)) {
            $fields[] = "lastname = :lastname";
        }
        if (!empty($email)) {
            $fields[] = "email = :email";
        }
        if (!empty($password)) {
            $fields[] = "passward = :password";
        }
        if (!empty($phone)) {
            $fields[] = "phone = :phone";
        }
        if (!empty($address)) {
            $fields[] = "address = :address";
        }

        $sql .= implode(", ", $fields);
        $sql .= " WHERE id = :user_id";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        if (!empty($firstname)) {
            $stmt->bindParam(':firstname', $firstname);
        }
        if (!empty($lastname)) {
            $stmt->bindParam(':lastname', $lastname);
        }
        if (!empty($email)) {
            $stmt->bindParam(':email', $email);
        }
        if (!empty($password)) {
            $options = [
                'cost' => 12
            ];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
            $stmt->bindParam(':password', $hashed_password);
        }
        if (!empty($phone)) {
            $stmt->bindParam(':phone', $phone);
        }
        if (!empty($address)) {
            $stmt->bindParam(':address', $address);
        }

        // Bind user ID
        $stmt->bindParam(':user_id', $user_id);

        // Execute the query
        $stmt->execute();
    }
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
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/global_fonts_style.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">
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

    <section class="nav-banner">
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
    </section>

    <section class="main-content paddnig80">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="main-width">
                        <center>
                            <h2>Profile</h2>
                        </center>
                        <form class="signup-form" action="profile_model.php" method="post" enctype="multipart/form-data">
                            <div class="wd70">
                                <div class="form-field">
                                    <label>First Name*</label>
                                    <input type="text" name="firstname" value="<?php echo $result['firstname'];  ?>" placeholder="Enter your First Name">
                                </div>
                                <div class="form-field">
                                    <label>Last Name*</label>
                                    <input type="text" name="lastname" placeholder="Enter your Last Name" value="<?php echo $result['lastname'];  ?>">
                                </div>
                            </div>

                            <div class="wd30">
                                <div class="upload-picture">
                                    <div class="fileUpload">
                                        <input type="file" name="photo" class="upload" accept="image/*" />
                                    </div>
                                    <label>Upload Image</label>
                                </div>
                            </div>

                            <div class="form-field">
                                <label>Email Address*</label>
                                <input type="email" name="email" placeholder="Enter your Email Address" value="<?php echo $result['email'];  ?>">
                            </div>
                            <div class="form-field">
                                <label>Password*</label>
                                <input type="password" name="passward" placeholder="Enter Password">
                            </div>
                            <div class="form-field">
                                <label>Confirm Password*</label>
                                <input type="password" name="copypawd" placeholder="Re-enter Password">
                            </div>
                            <div class="form-field">
                                <label>Phone Number* </label>
                                <input type="number" name="phone" placeholder="Enter your Phone Number" value="<?php echo $result['phone'];  ?>">
                            </div>

                            <div class="form-field">
                                <label>Address* </label>
                                <textarea name="address" placeholder="Enter your Address"><?php echo $result['address'];  ?></textarea>
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