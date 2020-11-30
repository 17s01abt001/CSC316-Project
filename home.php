<?php 

session_start();

?>



<!DOCTYPE html>
<html>
<head>
<title>HomePage</title>
</head>
<body>
<h1>Home</h1>
<div><h1>Welcome <?php echo $_SESSION['username'];  ?></h1></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>