<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');
session_start();
if (!isset($_SESSION['type'])) {
    header("Location: ../../index.php");
} else {
    ob_start();
    ?>

    <head>
    <?php
    include('../headsidecss.php');
    ?>

        <title>User Settings</title>
        <link rel="icon" href="../../img/logo.png">

        <style>
        .form-control:focus {
            border-color: #007bff; /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
            outline: none; /* Remove the default focus outline if needed */
        }
        </style>
    </head>

    <body class="hold-transition sidebar-mini">

        <div class="wrapper">
            <?php
            include('../sidebar.php');
            ?>


            <?php
            if ($_SESSION['type'] == "Nurse") {
                ?>

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
                    <h1 class="brand-link text-center">
                        <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">
                            Health Record Management
                        </span>
                    </h1>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar panel -->
                        <div class="user-panel pb-3 mb-3">
                            <center><img src="../../img/logo.png" style="height: 40%; width: 40%;" alt="logo"></center>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2" style="font-family: Helvetica;">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="../main/dashboard.php" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="../client/client-list.php" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Client
                            </p>
                        </a>
                    </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                  <a href="../main/report.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Custom Report</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="../main/client.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Follow-up Health Service</p>
                                  </a>
                                </li>
                            </ul>
                    </ul>

                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>


                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-8">
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <section class="content text-sm" style="font-family: Helvetica;">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <div class="card">

                                    <form method="post">
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <h5 class="font-weight-bold">User Settings</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>


                <div class="row">

               <?php
                    $id = $_GET['id'];
                    $edit = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$id'");
                    $row = mysqli_fetch_assoc($edit); ?>


                        <div>
                            <input name="user_id" type="hidden"
                            value="<?php echo $row['user_id']; ?>">
                        </div>

                        <div class="col-6">
                                <div class="form-group">
                            <label>First Name: </label>
                            <input name="fname" type="text" class="form-control form-control-sm"
                            value="<?php echo $row['fname']; ?>" oninput="validateInput(this)">
                        </div>
                        </div>
                        <div class="col-6">
                                <div class="form-group">
                            <label>Last Name: </label>
                            <input name="lname" type="text" class="form-control form-control-sm"
                            value="<?php echo $row['lname']; ?>" oninput="validateInput(this)">
                        </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username: </label>
                                <input name="username" class="form-control form-control-sm" 
                                type="text" value="<?php echo $row['username']; ?>" 
                                oninput="validateInput(this)">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password: </label>
                                <div class="input-group">
                                    <input id="passwordInput" name="password" class="form-control form-control-sm" type="password" value="<?php echo $row['password']; ?>" oninput="validateInput(this)">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fa fa-eye" onclick="togglePasswordVisibility()"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <input name="type" type="hidden"
                            value="<?php echo $row['type']; ?>">
                        </div>


                        </div>

                                <div class="modal-footer">
                                    <a href="../main/dashboard.php">
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </a>
                                    <button type="submit" name="update" class="btn btn-primary">Enter</button>
                                </div>

                        </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="col-3"></div>

                        </div>
                </div>
                </section>
            </div>

            </div>
            <!-- ./wrapper -->


        <?php
        if (isset($_POST['update'])) {

            $id = $_GET['id'];
            $user_id = $_POST['user_id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $type = $_POST['type'];

            mysqli_query($con, "UPDATE users SET user_id='$user_id', fname='$fname', lname='$lname', 
            username='$username', password='$password', type='$type' WHERE user_id = '$id'"); ?>

            <script type="text/javascript">
                window.location = "../main/dashboard.php";
            </script>
<?php
        }
        ?>



            <script>
                function validateInput(inputElement) {
                    let inputValue = inputElement.value;
                    let lettersOnly = inputValue.replace(/[^a-zA-Z\s.]/g, '');

                    if (inputValue !== lettersOnly) {
                        let selectionStart = inputElement.selectionStart;
                        let selectionEnd = inputElement.selectionEnd;

                        inputElement.value = lettersOnly;

                        // Restore cursor position
                        inputElement.setSelectionRange(selectionStart, selectionEnd);
                    }
                }

                // disable date
                const datePickers = document.querySelectorAll(".date-picker");

                    datePickers.forEach(function(datePicker) {
                        if (datePicker.value) {
                        datePicker.disabled = true;
                    }
                });
                    
                function togglePasswordVisibility() {
                    var passwordInput = document.getElementById('passwordInput');
                    var togglePassword = document.getElementById('togglePassword');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePassword.innerHTML = '<i class="fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>';
                    } else {
                        passwordInput.type = 'password';
                        togglePassword.innerHTML = '<i class="fa fa-eye" onclick="togglePasswordVisibility()"></i>';
                    }
                }
            </script>


        <?php } elseif ($_SESSION['type'] == "Barangay Health Worker") {
                header("Location: ../../index.php");
            } ?>

        <?php
}
?>

</body>

</html>