<?php
session_start();

?>

<!DOCT<!DOCTYPE html>
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
                            <a href="./account.php"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];  ?></a>
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
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Account Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $conn = mysqli_connect("localhost", "root","","project1");
                    $user = $_SESSION['username'];
                    $query = "SELECT * FROM usertable WHERE username='$user'";
                    $query_run = mysqli_query($conn,$query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>FullName</th>
                            <th>UserName</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>EDIT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($query_run)>0){
                            while ($row = mysqli_fetch_assoc($query_run)){
                                ?>
                                <tr>
                                    <td><?php echo $row['fullname']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['contactNo']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <form method="post" action="user_edit.php">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                            <button class="btn btn-success" name="edit_btn" type="submit">EDIT</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            echo "No Record Found!";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Account End -->

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

</body>

</html>