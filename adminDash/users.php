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
                <h1 class="mb-0 text-gray-800">Users</h1>
            </div>
        </div>
        <div class="card-body ">
        <div class="table-responsive">
            <?php
                $conn = mysqli_connect("localhost", "root","","project1");
                $query = "SELECT * FROM usertable";
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
                        <th>FullName</th>
                        <th>UserName</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (mysqli_num_rows($query_run)>0){
                        while ($row = mysqli_fetch_assoc($query_run)){
                           ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['contactNo']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td>
                            <form method="post" action="user_edit.php">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                <button class="btn btn-success" name="edit_btn" type="submit">EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="code.php">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button class="btn btn-danger" name="delete_btn" type="submit">DELETE</button>
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