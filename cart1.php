<?php
require 'config.php';
session_start();
if (empty($_SESSION['username'])){
    echo "<script>window.location = 'login.php'</script>";
}


require_once ("CreateDb.php");
require_once ("component.php");

$db = new CreateDb("Productdb", "Producttb");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}

$database = mysqli_connect("localhost", "root", "", "project1");

if (isset($_POST['paynow'])) {
    $mpesaname = $_POST['mpesaname'];
    $mpesano = $_POST['mpesano'];
    $mpesacode = $_POST['mpesacode'];
    $mpesatime = $_POST['mpesatime'];
    $street = $_POST['street'];
    $building = $_POST['building'];
    $houseNo = $_POST['houseNo'];
    $contact = $_POST['contact'];
    $purchase = $_SESSION['cart'];

    print_r($_SESSION['cart']);

    $sql = "INSERT INTO payments(MpesaName, MpesaNo, MpesaCode, MpesaTime, Street, Building, HouseNo, Contact, purchase) VALUES('$mpesaname','$mpesano','$mpesacode','$mpesatime','$street','$building','$houseNo','$contact','$purchase')";
    mysqli_query($database, $sql);
    echo "<script> alert('Your Payment has been saved we will contact you shortly')</script>";
    //header("location:shop.php");
    unset($_SESSION['cart']);
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
                            if (isset($_SESSION['cart'])){
                                $sql =  $conn->prepare("SELECT * FROM cart");
                                $sql->execute();
                                $sql->store_result();
                                $rows = $sql->num_rows;
                                echo "<span id=\"cart_count\" class=\"text-white bg-dark\">$rows</span>" ;
                            }
                            else{
                                echo "<span id=\"cart_count\" class=\"text-white bg-dark\">0</span>";
                            }
                            ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Cart Begin -->
<div class="container-fluid">
    <div class="row px-5 justify-content-center">
        <div class="col-lg-10">
            <div class="shopping-cart">
                <h2 class="text-center">My Cart</h2>
                <hr>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7"><h4 class="text-center m-0">Products in your Cart</h4></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-2" onclick="return confirm('Are you sure you want to clear the cart?');"><i class="fa fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require 'config.php';

                                $sql = $conn->prepare("SELECT * FROM cart");
                                $sql->execute();
                                $result = $sql->get_result();
                                $grand_total = 0;
                                while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><img src="<?= $row['product_image']?>" width="50"></td>
                                <input type="hidden" class="pid" name="pid" value="<?= $row['id']?>">
                                <td><?= $row['product_name']?></td>
                                <td><?= $row['product_price']?> Ksh</td>
                                <input type="hidden" class="pprice" name="pprice" value="<?= $row['product_price']?>">
                                <td><input type="number" class="form-control itemQty" name="itemQty" style="width: 75px" value="<?= $row['quantity']?>"></td>
                                <td><?= $row['total_price']?> Ksh</td>
                                <td>
                                    <a href="action.php?remove=<?= $row['id']?>" class="text-danger" onclick="return confirm('Are you sure you want to remove this item?')"><i class="fa fa-trash" style="font-size: 25px"></i></a>
                                </td>
                            </tr>
                             <?php $grand_total += $row['total_price'];?>
                            <?php endwhile;?>
                            <tr>
                                <td colspan="2">
                                    <a href="shop2.php" class="btn btn-info"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><?= $grand_total?> Ksh<b></b></td>
                                <td>
                                    <a href="checkout.php" class="btn btn-success <?= ($grand_total>1)?"":"disabled"; ?>"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>


<!-- Cart End -->

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

<script type="text/javascript">
    $(document).ready(function () {

    $(".itemQty").on('change',function () {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            console.log(qty);
            $.ajax({
               url: 'action.php',
               method: 'post',
               cache: false,
                data: {qty:qty,pid:pid,pprice:pprice},
                success: function (response) {
                   console.log(response);
                }
            });
        }):
    })
</script>

</body>

</html>