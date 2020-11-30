<?php

$conn = mysqli_connect("localhost","root","","project1");

if (isset($_POST['edit_statusid'])){
$id = $_POST['edit_statusid'];

$query = "UPDATE orders SET Status = 'Not Completed' WHERE id = '$id'";
$query_run = mysqli_query($conn,$query);

if ($query_run){
$_SESSION['success'] = "Your Data is Updated";
header('location:orders.php');
}
else{
$_SESSION['status'] = "Your Data is Not Updated";
header('location:orders.php');
}
}

?>
