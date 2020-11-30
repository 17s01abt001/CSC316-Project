<?php
session_start();
require 'config.php';

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

        header("location:shop.php");
    }
    else{
        //header("location:shop2.php");
        echo "<script> alert('Item Already in Cart!')</script>";
    }
}

if (isset($_SESSION['cartItem']) && isset($_SESSION['cartItem']) == 'cart_item'){
    $sql =  $conn->prepare("SELECT * FROM cart");
    $sql->execute();
    $sql->store_result();
    $rows = $sql->num_rows;
    echo $rows;

}

if (isset($_GET['remove'])){
    $id = $_GET['remove'];
    $sql = $conn->prepare("DELETE FROM cart WHERE id=?");
    $sql->bind_param("i",$id);
    $sql->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from cart!';
    header('location:cart.php');
}

if (isset($_GET['clear'])){
    $sql = $conn->prepare("DELETE FROM cart");
    $sql->execute();
    header('location:cart.php');

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from cart!';
    header('location:cart.php');
}

if (isset($_POST['itemQty'])){
    $qty = $_POST['itemQty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
    $tprice = $qty*$pprice;
    $sql = $conn->prepare("UPDATE cart SET quantity=?, total_price=? WHERE id=?");
    $sql = $conn->bind_parm("isi",$qty,$tprice,$pid);
    $sql->execute();


}


if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $products = $_POST['products'];
    $total = $_POST['grand_total'];
    $mpesaname = $_POST['mpesaname'];
    $mpesano = $_POST['mpesano'];
    $mpesacode = $_POST['mpesacode'];
    $mpesatime = $_POST['mpesatime'];

    $sql = "INSERT INTO orders(fullnames, address, products, MpesaName, MpesaNo, MpesaCode, MpesaTime, amount_paid) VALUES('$name','$address','$products','$mpesaname','$mpesano','$mpesacode','$mpesatime','$total')";
    mysqli_query($conn,$sql);
    header('location:shop.php');

    //$sql = $conn->prepare("INSERT INTO orders(fullnames, address, products, MpesaName, MpesaNo,MpesaCode,MpesaTime,amount_paid) VALUES((?,?,?,?,?,?,?,?)");
    //$sql->bind_param("ssssssss",$name,$address,$products,$mpesaname,$mpesano,$mpesacode,$mpesatime,$total);
    //$sql->execute();
    //header('location:shop2.php');

}

?>
