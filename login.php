<?php  

session_start();


$db = mysqli_connect("localhost", "root", "", "project1");

if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);
    $sql = " SELECT * FROM usertable WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['message'] = "You are now logged in";
        $_SESSION['username'] = $username;
        header("location:index.php");
    }
    else{
        echo "<script> alert('Username or Password is Incorrect')</script>";
        # $_SESSION['message'] = "Username Or Password is Incorrect";
    }
}





?>



<!DOCTY<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/login.css" type="text/css">

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
                            <a href="./login.php"><i class="fa fa-user"></i> Login</a>
                            <a href="./signup.php"><i class="fa fa-user-plus"></i>Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.html">Home</a></li>
                            <li><a href="./about.html">About Us</a></li>
                            <li><a href="./login.php">Shop</a></li>
                            <li><a href="./login.php">Shopping Cart</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- Header Section End -->

<!--Login Begin-->
 <form action="login.php" method="post">
  <div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h2>Login or <u><a href="signup.php" style ="color: #000000"> Sign Up</a></u></h2>

            <input type="hidden" name="userid" value="<?= $_SESSION['userid'] ?>">

            <label for="username"><b>Username</b></label>
            <input class="log" type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input class="log" type="password" placeholder="Enter Password" name="password" required>

            <button class="log" name="login_btn" type="submit">Login</button>
        </div>
    </div>   
   </div>
  <div class="container">
    <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><a href="#">Forgot Password?</a></span>
  </div>
</div>
</div>
</form> 
<!--Login End-->

<!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
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
                            <li><a href="./about.html">About Us</a></li>
                            <li><a href="./login.php">Our Products</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="./contact.html">Contact Us</a></li>
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

</body>

</html>