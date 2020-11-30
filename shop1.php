<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="M-Soko">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Soko</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">



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
                            <li><a href="./shoping-cart.php">Shopping Cart</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i> <span id="cart-item" class="badge badge-success"></span></a></li>
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
                    <div id="message"></div>
                    <div class="row">
                        <?php
                            include 'config.php';
                            $sql = $conn->prepare("SELECT * FROM producttb");
                            $sql->execute();
                            $result = $sql->get_result();
                            while ($row = $result->fetch_assoc()):
                        ?>
                        <div class="col-lg-4">
                            <div class="card-deck">
                                <div class="card p-2 border-0 mb-2">
                                    <img src="<?= $row['product_image']?>" class="card-img-top" height="255" width="270">
                                    <div class="card-body h-100 p-1">
                                        <h4 class="card-title text-center text-black-100" style="font-size: 20px"><?= $row['product_name']?></h4>
                                        <h5 class="card-text text-center text-black-100 font-weight-bold"><?= number_format($row['product_price'])?>Ksh</h5>
                                    </div>
                                    <div class="card-footer p-1">
                                        <form action="" class="form-submit">
                                            <input type="hidden" class="pid" value="<?= $row['id']?>">
                                            <input type="hidden" class="pname" value="<?= $row['product_name']?>">
                                            <input type="hidden" class="pprice" value="<?= $row['product_price']?>">
                                            <input type="hidden" class="pimage" value="<?= $row['product_image']?>">
                                            <input type="hidden" class="pcode" value="<?= $row['product_code']?>">
                                            <button class="btn btn-success btn-block addItemBtn"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".addItemBtn.").click(function (e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit.");
                var pid = $form.find(".pid.").val();
                var pname = $form.find(".pname.").val();
                var pprice = $form.find(".pprice.").val();
                var pimage = $form.find(".pimage.").val();
                var pcode = $form.find(".pcode.").val();

                $.ajax({
                    url: 'action.php';
                    method: 'post',
                    data: {pid:pid,pname:pname,pprice:pprice,pimage:pimage,pcode:pcode},
                    success:function (responce) {
                        $("#message").html(responce);
                        load_cart_item_number();
                    }
                });
            });

            load_cart_item_number();
            function load_cart_item_number() {
                $.ajax({
                   url: 'action.php',
                   method: 'get',
                   data: {cartItem:"cart_item"},
                   success: function(response){
                       $("#cart-item").html(response);
                   }
                });

            }
        });

    </script>

</body>

</html>