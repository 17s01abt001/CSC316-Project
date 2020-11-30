<?php

session_start();

$conn = mysqli_connect("localhost","root","","project1");

if (isset($_POST['edit_id'])){
    $id = $_POST['edit_id'];

    echo $id;


}

if (isset($_POST['update_btn'])){
    $id = $_POST['edit_id'];
    $fullname = $_POST['edit_fullname'];
    $username = $_POST['edit_username'];
    $contactNo = $_POST['edit_contactNo'];
    $email = $_POST['edit_email'];
    $address = $_POST['edit_address'];

    $query = "UPDATE usertable SET fullname = '$fullname', username = '$username', contactNo = '$contactNo', email = '$email', address = '$address' WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Updated";
        header('location:users.php');
    }
    else{
        $_SESSION['status'] = "Your Data is Not Updated";
        header('location:users.php');
    }
}


if (isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM usertable WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Deleted";
        header('location:users.php');
    }
    else{
        $_SESSION['status'] = "Your Data was not Deleted";
        header('location:users.php');
    }


}

///

if (isset($_POST['edit_pid'])){
    $id = $_POST['edit_pid'];

    echo $id;


}

if (isset($_POST['update_pbtn'])){
    $id = $_POST['edit_pid'];
    $productname = $_POST['edit_product_name'];
    $productprice = $_POST['edit_product_price'];
    $productimg = $_POST['edit_product_image'];
    $productcat = $_POST['edit_product_cat'];
    $productcode = $_POST['edit_product_code'];

    $query = "UPDATE producttb SET product_name = '$productname', product_price = '$productprice', product_image = '$productimg', product_cat = '$productcat', product_code = '$productcode' WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Updated";
        header('location:products.php');
    }
    else{
        $_SESSION['status'] = "Your Data is Not Updated";
        header('location:products.php');
    }
}


if (isset($_POST['delete_pbtn'])){
    $id = $_POST['delete_pid'];

    $query = "DELETE FROM producttb WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Deleted";
        header('location:products.php');
    }
    else{
        $_SESSION['status'] = "Your Data was not Deleted";
        header('location:products.php');
    }


}


/////

if (isset($_POST['login_btn'])) {
    $username = $_POST['InputUsername'];
    $password = $_POST['InputPassword'];

    $password = md5($password);
    $sql = " SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['message'] = "You are now logged in";
        $_SESSION['usernameadd'] = $username;
        header("location:admin.php");
    }
    else{
        echo "<script> alert('Username or Password is Incorrect')</script>";
        header("location:login.php");
    }
}


////
if (isset($_POST['complete_btn'])){
    $id = $_POST['edit_statusid'];

    $query = "UPDATE orders SET status='Completed And Delivered' WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Deleted";
        header('location:orders.php');
    }
    else{
        $_SESSION['status'] = "Your Data was not Deleted";
        header('location:orders.php');
    }


}

if (isset($_POST['not_complete_btn'])){
    $id = $_POST['edit_statusid'];

    $query = "UPDATE orders SET status='Not Completed' WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Deleted";
        header('location:orders.php');
    }
    else{
        $_SESSION['status'] = "Your Data was not Deleted";
        header('location:orders.php');
    }


}


if (isset($_POST['add_btn'])){
    $productname = $_POST['add_product_name'];
    $productprice = $_POST['add_product_price'];
    $productimg = $_POST['add_product_image'];
    $productcat = $_POST['add_product_cat'];
    $productcode = $_POST['add_product_code'];

    $query = "INSERT INTO producttb(product_name,product_price,product_image,product_cat,product_code) VALUES('$productname','$productprice','$productimg','$productcat','$productcode')";
    $query_run = mysqli_query($conn,$query);

    if ($query_run){
        $_SESSION['success'] = "Your Data is Deleted";
        header('location:Products.php');
    }
    else{
        $_SESSION['status'] = "Your Data was not Deleted";
        header('location:Products.php');
    }

}
?>

