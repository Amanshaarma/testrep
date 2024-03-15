<?php
require_once 'ListPropertyAndSearchphp/ListProperty.php';
if (!(isset($_SESSION["user_id"]))) {
    header('Location: login.html');
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
                        <!-- <li><a href="signup.html">Sign Up</a></li>
                         <li><a href="login.html">Login</a></li> -->
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
                        <h2>Property Listings</h2>
                        <?php
                        if(isset($_SESSION['serachResult'])&&$_SESSION['serachResult'])
                        {
                            $result = $_SESSION['serachResult'];
                            unset($_SESSION['serachResult']);
                        }
                        foreach ($result as $key) {
                            echo '<div class="product-list">';
                            //  echo '<img src="data:image;base64,' . base64_encode($key["image"]) .' '. 'class="property-img" alt="Not found" >';
                            echo '<img src="data:image;base64,' . base64_encode($key['image']) . '" class="property-img" alt="Image">';
                            echo ' <ul>';
                            echo ' <li><img src="images/icon-user.png" alt="user"><strong>Property Name: </strong>' . $key['propName'] . '</li>';
                            echo ' <li><img src="images/icon-home.png" alt="home"><strong>Property Type: </strong>' . $key['price'] . ' </li>';
                            echo '    <li><img src="images/icon-doller.png" alt="doller"><strong>Price: </strong>' . $key['propType'] . '</li>';
                            echo '    <li><img src="images/icon-location.png" alt="location"><strong>Location: </strong>' . $key['location'] . '</li>';
                            echo '</ul>';
                            echo '<p>' . $key['description'] . '</p>';
                            echo '<div class="button-container">
                                 <a href="DeleteAndEdit/Editproperty.php?key='.$key['prop_id'] .'"><button>Edit </button></a>
                                 <a href="DeleteAndEdit/delete.php?key='.$key['prop_id'] .'"><button>Delete</button></a>
                            </div>';

                            echo '</div>';
                        }
                        
                        $result = null;
                        ?>


                        <!-- <div class="product-list">
                            <img src="images/home-23.png" alt="home" class="property-img">
                            <ul>
                                <li><img src="images/icon-user.png" alt="user"><strong>Property Name: </strong>Loreum Ipsum</li>
                                <li><img src="images/icon-home.png" alt="home"><strong>Property Type: </strong>Rent</li>
                                <li><img src="images/icon-doller.png" alt="doller"><strong>Price: </strong>$ 132,556</li>
                                <li><img src="images/icon-location.png" alt="location"><strong>Location: </strong>Loreum Ipsum</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a sollicitudin lacus, faucibus ornare ante</p>

                        </div> -->

                        <!-- 
                        <div class="product-list">
                            <img src="images/home-23.png" alt="home" class="property-img">
                            <ul>
                               <li><img src="images/icon-user.png" alt="user"><strong>Property Name: </strong>Loreum Ipsum</li>
                               <li><img src="images/icon-home.png" alt="home"><strong>Property Type: </strong>Rent</li>
                               <li><img src="images/icon-doller.png" alt="doller"><strong>Price: </strong>$ 132,556</li>
                               <li><img src="images/icon-location.png" alt="location"><strong>Location: </strong>Loreum Ipsum</li>
                          </ul>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a sollicitudin lacus, faucibus ornare ante</p>
                          
                       </div> -->

                        <a href="#" class="load-btn">Load More</a>

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