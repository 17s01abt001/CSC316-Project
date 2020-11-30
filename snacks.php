<?php
session_start();
require 'config.php';
if (empty($_SESSION['username'])){
    echo "<script>window.location = 'login.html'</script>";
}


if (isset($_POST['add'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    $sql = $conn->prepare("SELECT product_code FROM cart WHERE product_code=?");
    $sql->bind_param("s",$pcode);
    $sql->execute();
    $result = $sql->get_result();
    $r = $result->fetch_assoc();
    $code = $r['product_code'];

    if (!$code){
        $query = $conn->prepare("INSERT INTO cart(product_name,product_price,product_image,quantity,total_price,product_code) VALUES (?,?,?,?,?,?)");
        $query->bind_param("sssiss",$pname,$pprice,$pimage,$pqty,$pprice,$pcode);
        $query->execute();

        header("location:snacks.php");
    }
    else{
        //header("location:shop2.php");
        echo "<script> alert('Item Already in Cart!')</script>";
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
                                $sql =  $conn->prepare("SELECT * FROM cart");
                                $sql->execute();
                                $sql->store_result();
                                $rows = $sql->num_rows;
                                echo "<span id=\"cart_count\" class=\"text-white bg-dark\">$rows</span>" ;
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                            <li><a href="./shop.php">All</a></li>
                            <li><a href="./bread.php">Bread</a></li>
                            <li><a href="./drinks.php">Drinks</a></li>
                            <li><a href="./snacks.php">Snacks</a></li>
                            <li><a href="./candy.php">Candy</a></li>
                            <li><a href="./credit.php">Credit</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <?php
                        include 'config.php';
                        $sql = $conn->prepare("SELECT * FROM producttb WHERE product_cat='Snack'");
                        $sql->execute();
                        $result = $sql->get_result();
                        while ($row = $result->fetch_assoc()):
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?= $row['product_image']?>" style='background-image: url("<?= $row['product_image']?>");'>
                                        <ul class="product__item__pic__hover">
                                            <form action="snacks.php" method="post" class="form-submit">
                                                <input type="hidden" name="pid" value="<?= $row['id']?>">
                                                <input type="hidden" name="pname" value="<?= $row['product_name']?>">
                                                <input type="hidden" name="pprice" value="<?= $row['product_price']?>">
                                                <input type="hidden" name="pimage" value="<?= $row['product_image']?>">
                                                <input type="hidden" name="pcode" value="<?= $row['product_code']?>">
                                                <li><button href="#"><i class="fa fa-heart"></i></button></li>
                                                <li><button name= "add" type="submit" class="addItemBtn"><i class="fa fa-shopping-cart"></i></button></li>
                                            </form>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><?= $row['product_name']?></h6>
                                        <h5><?= number_format($row['product_price'])?> Ksh</h5>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

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