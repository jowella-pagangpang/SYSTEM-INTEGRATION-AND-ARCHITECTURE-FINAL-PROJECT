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

        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <title>Client List</title>
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
            if ($_SESSION['type'] == "Barangay Health Worker") {
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
                                    <a href="../main/dashboard.php" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../client/client-list.php" class="nav-link active">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>
                                            Client
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p>
                                            Health Services
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../immunization/immunization.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Immunization Services</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming1/deworming.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming Services</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition2/nutrition2.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition Program</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../sickchildren/sickchildren.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Sick Children</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../maternal/maternal.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Maternal Care</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../postpartum/postpartum.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Postpartum Care</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../client/general-consult.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>General Consultation</p>
                                            </a>
                                        </li>
                                    </ul>
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
                                                <p>Custom Report</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../main/client.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Follow-up Health Service</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
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
                                    <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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

                                    <form method="post" action="add.php">
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <h5 class="font-weight-bold">Edit client</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>



                                            <div class="row">

                                            <?php
                                                $id = $_GET['id'];
                                                $edit = mysqli_query($con, "SELECT * FROM client WHERE id = '$id'");
                                                $row = mysqli_fetch_assoc($edit); ?>

<div>
    <input name="id" type="hidden"
    value="<?php echo $row['id']; ?>">
</div>

<div class="col-4">
        <div class="form-group">
    <label>Name: <code class="text-danger">*</code></label>
    <input name="fname" type="text" class="form-control form-control-sm"
    value="<?php echo $row['fname']; ?>" oninput="validateInput(this)">
</div>
</div>
<div class="col-4">
        <div class="form-group">
    <label><br></label>
    <input name="minitial" type="text" class="form-control form-control-sm"
    value="<?php echo $row['minitial']; ?>" oninput="validateInput(this)">
</div>
</div>
<div class="col-4">
        <div class="form-group">
    <label><br></label>
    <input name="lname" type="text" class="form-control form-control-sm"
    value="<?php echo $row['lname']; ?>" oninput="validateInput(this)">
</div>
</div>

<div class="col-md-12">
    <div class="form-group">

    <?php
$birthDate = $row['birth_date'];
$readonly = ($birthDate === '0000-00-00') ? '' : 'readonly';
?>

        <label>Date of Birth: <code class="text-danger">*</code></label>
        <input name="birth_date" class="form-control form-control-sm" type="date"
        value="<?php echo $birthDate; ?>" <?php echo $readonly; ?>>
    </div>
</div>

<div class="col-md-6">
        <label>Sex: <code class="text-danger">*</code><br></label>
        <div class="form-group">
            <div class="icheck-primary">
                <input type="radio" name="sex" value="M" id="radioPrimary1" 
                <?php if ($row['sex'] == "M") echo 'checked'; ?>>
                <label for="radioPrimary1">
                    <span class="text" style="font-weight: normal;">
                        Male
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label><br></label>
        <div class="form-group">
            <div class="icheck-primary">
                <input type="radio" name="sex" value="F" id="radioPrimary2" 
                <?php if ($row['sex'] == "F") echo 'checked'; ?>>
                <label for="radioPrimary2">
                    <span class="text" style="font-weight: normal;">
                        Female
                    </span>
                </label>
            </div>
        </div>
    </div>

<div class="col-md-12">
    <div class="form-group">
        <label>Name of Mother:</label>
        <input name="mother_name" class="form-control form-control-sm" 
        type="text" value="<?php echo $row['mother_name']; ?>" 
        oninput="validateInput(this)">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Complete Address: <code class="text-danger">*</code><br></label>
        <select name="purok" class="form-control form-control-sm">
            <option selected><?php echo $row['purok']; ?></option>
            <option value="Purok 93">Purok 93</option>
            <option value="Purok 94">Purok 94</option>
            <option value="Purok 95">Purok 95</option>
            <option value="Purok 96">Purok 96</option>
            <option value="Purok 97">Purok 97</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><br></label>
        <input name="address" class="form-control form-control-sm" type="text"
            value="<?php echo $row['address']; ?>" readonly>
    </div>
</div>

</div>


                                            <div class="modal-footer">
                                                <a href="../client/client-list.php">
                                                    <button type="button" class="btn btn-default">Cancel</button>
                                                </a>
                                                <button type="submit" name="update" class="btn btn-primary">Edit</button>
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
            </script>


        <?php } elseif ($_SESSION['type'] == "Nurse") {
                header("Location: ../../index.php");
            } ?>

        <?php
}
?>

</body>

</html>