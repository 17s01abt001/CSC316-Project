<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');

if (empty($_SESSION['usernameadd'])) {
    echo "<script>window.location = 'login.php'</script>";
}

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

<?php
$conn = mysqli_connect("localhost","root","","project1");

if (isset($_POST['edit_btn'])){
    $id = $_POST['edit_btn'];

    $query = "SELECT * FROM usertable WHERE id = '$id'";
    $query_run = mysqli_query($conn,$query);


}
?>

        <div class="container-fluid pt-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <div class="card-body">
                    <?php
                    $conn = mysqli_connect("localhost","root","","project1");
                    if (isset($_POST['edit_id'])){
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM usertable WHERE id = '$id'";
                        $query_run = mysqli_query($conn,$query);

                        foreach ($query_run as $row){
                    ?>
                            <form action="code.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label> Fullname </label>
                        <input type="text" name="edit_fullname" value="<?php echo $row['fullname']; ?>" class="form-control" placeholder="Enter Fullname">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="edit_username" value="<?php echo $row['username']; ?>"class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Contact No.</label>
                        <input type="text" name="edit_contactNo" value="<?php echo $row['contactNo']; ?>"class="form-control" placeholder="Enter Contact No.">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="edit_email" value="<?php echo $row['email']; ?>"class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="edit_address" value="<?php echo $row['address']; ?>"class="form-control" placeholder="Enter Address">
                    </div>
                        <a href="users.php" class="btn btn-danger">CANCEL</a>
                        <button type="submit" name="update_btn" class="btn btn-primary">UPDATE</button>
                            </form>
                    <?php
                        }
                    }
                    ?>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
