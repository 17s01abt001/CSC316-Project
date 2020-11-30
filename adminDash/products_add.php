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

        <div class="container-fluid pt-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                </div>
                <div class="card-body">
                            <form action="code.php" method="post">
                                <div class="form-group">
                                    <label> Product Name </label>
                                    <input type="text" name="add_product_name" class="form-control" placeholder="Enter Product Name">
                                </div>
                                <div class="form-group">
                                    <label> Product Price</label>
                                    <input type="float" name="add_product_price" class="form-control" placeholder="Enter Product Price">
                                </div>
                                <div class="form-group">
                                    <label> Product Image </label>
                                    <input type="text" name="add_product_image" class="form-control" placeholder="Enter Product Image Location">
                                </div>
                                <div class="form-group">
                                    <label> Product Category </label>
                                    <input type="text" name="add_product_cat" class="form-control" placeholder="Enter Product Category">
                                </div>
                                <div class="form-group">
                                    <label> Product Code</label>
                                    <input type="text" name="add_product_code" class="form-control" placeholder="Enter Product Code">
                                </div>
                                <a href="products.php" class="btn btn-danger">CANCEL</a>
                                <button type="submit" name="add_btn" class="btn btn-primary">ADD</button>
                            </form>
                </div>
            </div>

        </div>
        <!-- End of Main Content -->
        <?php
        include('includes/scripts.php');
        include('includes/footer.php');
        ?>

