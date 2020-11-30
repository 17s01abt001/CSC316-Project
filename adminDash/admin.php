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

        <!-- Begin Page Content -->
        <div class="container-fluid pt-5">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between p-2 mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $conn = mysqli_connect("localhost","root","","project1");
                                        $query = "SELECT id FROM usertable ORDER BY id";
                                        $query_run = mysqli_query($conn,$query);
                                        $row = mysqli_num_rows($query_run);
                                        echo '<h1>'.$row.'</h1>'
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Products On-Sale</div>
                                    <?php
                                    $conn = mysqli_connect("localhost","root","","project1");
                                    $query = "SELECT id FROM producttb ORDER BY id";
                                    $query_run = mysqli_query($conn,$query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h1>'.$row.'</h1>'
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orders</div>
                                    <?php
                                    $conn = mysqli_connect("localhost","root","","project1");
                                    $query = "SELECT id FROM orders ORDER BY id";
                                    $query_run = mysqli_query($conn,$query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h1>'.$row.'</h1>'
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Uncompleted Orders</div>
                                    <?php
                                    $conn = mysqli_connect("localhost","root","","project1");
                                    $query = "SELECT id FROM orders WHERE Status = 'Not Completed' ORDER BY id";
                                    $query_run = mysqli_query($conn,$query);
                                    $row = mysqli_num_rows($query_run);
                                    echo '<h1>'.$row.'</h1>'
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>







