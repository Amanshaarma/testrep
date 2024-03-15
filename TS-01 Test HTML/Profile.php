<?php


session_start();

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
    <link rel="stylesheet" href="css/profile.css" type="text/css">
    <link rel="stylesheet" href="../css/profile.css">
    <script src="../js/profile.js"></script>
</head>
<style>
    #hidden {
        display: none;

    }
</style>

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
                            <!-- <li><a href="signup.php">Sign Up</a></li>
                         <li><a href="login.php">Login</a></li> -->
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
                        <div class="container">
                            <div class="profile-header">
                                <h2>Profile</h2>
                               <?php echo '<img src="data:image;base64,' . base64_encode($result['photo']) . '" class="profile-picture" width="150" height="150" alt="Image">';?>
                                <!-- <span class="font-weight-bold">Edogaru</span>
                                <span class="text-black-50">edogaru@mail.com.my</span> -->
                               
                            </div>

                            <div class="profile-content">
                                <div class="profile-info">
                                    <ul>
                                        <li><img src="images/icon-user.png" alt="user"><strong>First Name:</strong> <?php echo $result['firstname']; ?></li>
                                        <li><img src="images/icon-user.png" alt="user"><strong>Last Name:</strong> <?php echo $result['lastname']; ?></li>
                                        <li><img src="images/icon-home.png" alt="home"><strong>Phone:</strong> <?php echo $result['phone']; ?></li>
                                        <li><img src="images/icon-doller.png" alt="dollar"><strong>Email:</strong> <?php echo $result['email']; ?></li>
                                        <li><img src="images/icon-location.png" alt="location"><strong>Address:</strong> <?php echo $result['address']; ?></li>
                                    </ul>
                                </div>
                
                            </div>    
                        </div>
                        <!-- <div class="upload-picture">
                                <input type="file" id="photo" name="photo" accept="image/*">
                                <label for="photo">Change Profile Picture</label>
                            </div> -->
                            <div class="form-field">
                           <a href="profile_model.php"><input type="submit" value="Edit"></a> 
                       </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="js/jquery-3.5.1.min.js" type="/text/javascript"></script>
    <script src="js/bootstrap.min.js" type="/text/javascript"></script>
    <script src="js/script.js" type="/text/javascript"></script>



</body>

</html>