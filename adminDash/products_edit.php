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

        if (isset($_POST['edit_pbtn'])){
            $id = $_POST['edit_pbtn'];

            $query = "SELECT * FROM producttb WHERE id = '$id'";
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
                    if (isset($_POST['edit_pid'])){
                        $id = $_POST['edit_pid'];

                        $query = "SELECT * FROM producttb WHERE id = '$id'";
                        $query_run = mysqli_query($conn,$query);

                        foreach ($query_run as $row){
                            ?>
                            <form action="code.php" method="post">
                                <input type="hidden" name="edit_pid" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label> Product Name </label>
                                    <input type="text" name="edit_product_name" value="<?php echo $row['product_name']; ?>" class="form-control" placeholder="Enter Product Name">
                                </div>
                                <div class="form-group">
                                    <label> Product Price</label>
                                    <input type="float" name="edit_product_price" value="<?php echo $row['product_price']; ?>"class="form-control" placeholder="Enter Product Price">
                                </div>
                                <div class="form-group">
                                    <label> Product Image </label>
                                    <input type="text" name="edit_product_image" value="<?php echo $row['product_image']; ?>"class="form-control" placeholder="Enter Product Image">
                                </div>
                                <div class="form-group">
                                    <label> Product Category </label>
                                    <input type="text" name="edit_product_cat" value="<?php echo $row['product_cat']; ?>"class="form-control" placeholder="Enter Product Category">
                                </div>
                                <div class="form-group">
                                    <label> Product Code</label>
                                    <input type="text" name="edit_product_code" value="<?php echo $row['product_code']; ?>"class="form-control" placeholder="Enter Product Code">
                                </div>
                                <a href="products.php" class="btn btn-danger">CANCEL</a>
                                <button type="submit" name="update_pbtn" class="btn btn-primary">UPDATE</button>
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
