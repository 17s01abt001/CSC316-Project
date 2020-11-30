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

        <div class="card-header pt-5">
            <div class="row no-gutters justify-content-between">
                <h1 class="mb-0 text-gray-800">Orders</h1>
            </div>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <?php
                $conn = mysqli_connect("localhost", "root","","project1");
                $query = "SELECT * FROM orders";
                $query_run = mysqli_query($conn,$query);

                if (isset($_SESSION['success']) && $_SESSION['success'] !=''){
                    echo '<h2>'.$_SESSION['success'].'</h2>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['status']) && $_SESSION['status'] !=''){
                    echo '<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
                    unset($_SESSION['status']);
                }
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Address</th>
                        <th>Products</th>
                        <th>Mpesa Name</th>
                        <th>Mpesa Number</th>
                        <th>Mpesa Transaction Code</th>
                        <th>Mpesa Payment Time</th>
                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (mysqli_num_rows($query_run)>0){
                        while ($row = mysqli_fetch_assoc($query_run)){
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fullnames']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['products']; ?></td>
                                <td><?php echo $row['MpesaName']; ?></td>
                                <td><?php echo $row['MpesaNo']; ?></td>
                                <td><?php echo $row['MpesaCode']; ?></td>
                                <td><?php echo $row['MpesaTime']; ?></td>
                                <td><?php echo $row['amount_paid']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td>
                                    <form method="post" action="code.php">
                                        <input type="hidden" name="edit_statusid" value="<?php echo $row['id']; ?>">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" style="">
                                            <a class="dropdown-item"><button class="btn btn-primary w-100" type="submit" name="not_complete_btn">Not Completed</button></a>
                                            <a class="dropdown-item" ><button class="btn btn-primary w-100" type="submit" name="complete_btn">Completed</button></a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo "No Record Found!";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>