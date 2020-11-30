<?php

require 'config.php';
session_start();

if (empty($_SESSION['username'])) {
    echo "<script>window.location = 'login.php'</script>";
}

$grand_total = 0;
$allItems = '';
$items = array();

$sql = "SELECT CONCAT(product_name,'(',quantity,')') AS ItemQty,total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}

$allItems = implode(",",$items );


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

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" /> -->

    <!-- Bootstrap CDN
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    -->
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

<!-- Cart Begin -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h4 class="text-center text-success p-2">Complete Your Order</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <span class="d-flex align-items-center justify-content-between"><h6><b>MPESA CHECKOUT</b></h6><img class="float-right" src="img/mpesa.png"></span>
                <h5>Send Mpesa to:</h5><h5 class="text-success"> +254740666913 </h5><br>
                <h5>Mpesa Recipient Name:</h5><h5 class="text-success"> Rupesh Kerai</h5>
            </div>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
                <br>
                <h5><b>Total Amount Payable : </b><?= $grand_total; ?> Ksh</h5>
            </div>
            <form action="action.php" method="post" id="placeOrder">
                <input type="hidden" name="products" value="<?= $allItems ?>">
                <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                <div class="form-group">
                    <input class="form-control" name="name" type="text" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="address" type="text" placeholder="Enter Delivery Address Here.." required></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" name="mpesaname" type="text" placeholder="Enter Mpesa Sender Name" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="mpesano" type="text" placeholder="Enter Mpesa Sender No" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="mpesacode" type="text" placeholder="Enter Mpesa Transaction Code" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="mpesatime" type="text" placeholder="Enter Mpesa Transation Time As per Message" required>
                </div>
                <div class="form-group"></div>
                    <input class="btn-success btn btn-block" name="submit" type="submit" value="Place Order">
                </div>
            </form>
        </div>
    </div>
</div>

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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</body>

</html>
