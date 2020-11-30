<?php 
session_start();
if (empty($_SESSION['username'])){
    echo "<script>window.location = 'contact.html'</script>";
}

$db = mysqli_connect("localhost", "root", "", "project1");

if (isset($_POST['contact_us'])) {
    $fullnames = $_POST['fullnames'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($fullnames) || empty($email) || empty($message)) {
        echo "<script>alert('All fields required')</script>";
        echo "<script>window.location = 'contact.php'</script>";

    } else {
        $sql = "INSERT INTO contact(fullnames, email, message) VALUES ('$fullnames','$email','$message')";
        mysqli_query($db, $sql);
        echo "<script>alert('Your Message has been received we will contact you shortly.')</script>";
        echo "<script>window.location = 'contact.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="M-Soko">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo_fav.png">
    <title>M-Soko</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> info@msoko.com</li>
                        </ul>
                    </div>
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            <a href="./login.php"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];  ?></a>
                            <a href="./logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./shop.php">Shop</a></li>
                            <li><a href="./cart.php">Shopping Cart</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                                <?php
                                require 'config.php';
                                $sql =  $conn->prepare("SELECT * FROM cart");
                                $sql->execute();
                                $sql->store_result();
                                $rows = $sql->num_rows;
                                echo "<span id=\"cart_count\" class=\"text-white bg-dark\">$rows</span>" ;
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-phone"></span>
                        <h4>Phone</h4>
                        <p>+254 739 622 773</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-map-marker"></span>
                        <h4>Address</h4>
                        <p>Kolobot Road, Ngara, Nairobi</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-envelope"></span>
                        <h4>Email</h4>
                        <p>info@msoko.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Section Begin -->
    <div class="map">
        <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=500&amp;hl=en&amp;q=kolobot%20road,%20Ngara,%20Nairobi+(M-soko)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="720" height="500" frameborder="0"></iframe>
    </div>
    <!-- Map Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <form action="contact.php" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="fullnames" placeholder="Full Name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="email" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="message" placeholder="Your message"></textarea>
                        <button type="submit" name="contact_us" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.php"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: Kolobot Road, Ngara, Nairobi</li>
                            <li>Phone: +254 739 622 773</li>
                            <li>Email: info@msoko.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./shop.php">Our Products</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="./contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>Copyright ©2020 | All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</body>

</html>