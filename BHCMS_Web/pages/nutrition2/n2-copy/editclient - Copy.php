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

        <title>Nutrition and EPI Part II</title>
        <link rel="icon" href="../../img/logo.png">

        <style>
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
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#" class="nav-link active">
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
                                                <p>Immunization (0-12 mos. old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming1/deworming1-4.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (1-4 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming2/deworming5-9.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (5-9 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming3/deworming10-19.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (10-19 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition1/nutrition1.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program I</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition2/nutrition2.php" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program II</p>
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
                                    <p> Generate Report</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="../main/client.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Client Report</p>
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
                            <div class="col-12">
                                <div class="card">

                                    <form method="post">
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-5">

                                                        <h5 class="font-weight-bold">Edit client record</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">

                                                <?php
                                                $nid2 = $_GET['nid2'];
                                                $edit = mysqli_query($con, "SELECT * FROM nutrition2 WHERE nutrition2_id = '$nid2'");
                                                $row = mysqli_fetch_assoc($edit); ?>


                                                <div>
                                                    <input type="hidden" name="nutrition2_id"
                                                        value="<?php echo $row['nutrition2_id']; ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of Registration:</label>
                                                        <input name="reg_date" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['reg_date']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of Birth:</label>
                                                        <input name="birth_date" class="form-control form-control-sm"
                                                            type="date" value="<?php echo $row['birth_date']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2">
                                                    <label>Name of Child:</label>
                                                    <input name="fname" type="text" class="form-control form-control-sm"
                                                        value="<?php echo $row['fname']; ?>" 
                                                        oninput="validateInput(this)">
                                                </div>
                                                <div class="col-2">
                                                    <label><br></label>
                                                    <input name="minitial" type="text" class="form-control form-control-sm"
                                                        value="<?php echo $row['minitial']; ?>" 
                                                        oninput="validateInput(this)">
                                                </div>
                                                <div class="col-2">
                                                    <label><br></label>
                                                    <input name="lname" type="text" class="form-control form-control-sm"
                                                        value="<?php echo $row['lname']; ?>" 
                                                        oninput="validateInput(this)">
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Weight:<br></label>
                                                        <input name="weight" class="form-control form-control-sm" type="number"
                                                            value="<?php echo $row['weight']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Height:<br></label>
                                                        <input name="height" class="form-control form-control-sm" type="number"
                                                            value="<?php echo $row['height']; ?>">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Sex:<br></label>
                                                        <select name="sex" class="form-control form-control-sm"
                                                            style="width: 100%;" required>
                                                            <option selected>
                                                                <?php echo $row['sex']; ?>
                                                            </option>
                                                            <option value="M">M</option>
                                                            <option value="F">F</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Age:<br></label>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" name="6to11mos" value="✓" id="todoCheck3"
                                                                <?php if ($row['6to11mos'] == "✓")
                                                                    echo 'checked'; ?>>
                                                            <label for="todoCheck3"></label>
                                                            <span class="text">6-11 months</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label><br></label>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" name="12to59mos" value="✓" id="todoCheck4"
                                                                <?php if ($row['12to59mos'] == "✓")
                                                                    echo 'checked'; ?>>
                                                            <label for="todoCheck4"></label>
                                                            <span class="text">12-59 months</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complete Name of Mother:</label>
                                                        <input name="mother_name" class="form-control form-control-sm"
                                                            type="text" value="<?php echo $row['mother_name']; ?>" oninput="validateInput(this)">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Complete Address:<br></label>
                                                        <select name="purok" class="form-control form-control-sm"
                                                            style="width: 100%;" required>
                                                            <option selected>
                                                                <?php echo $row['purok']; ?>
                                                            </option>
                                                            <option value="Purok 93">Purok 93</option>
                                                            <option value="Purok 94">Purok 94</option>
                                                            <option value="Purok 95">Purok 95</option>
                                                            <option value="Purok 96">Purok 96</option>
                                                            <option value="Purok 97">Purok 97</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><br></label>
                                                        <input name="address" class="form-control form-control-sm" type="text"
                                                            value="<?php echo $row['address']; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Vitamin A (6-11 months):</label>
                                                        <input name="vitamina" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['vitamina']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vitamin A 12-59 months (Dose 1):</label>
                                                        <input name="vitamin1" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['vitamin1']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vitamin A 12-59 months (Dose 2):</label>
                                                        <input name="vitamin2" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['vitamin2']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Iron (6-11 months):</label>
                                                        <input name="iron1" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['iron1']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Iron (12-59 months):</label>
                                                        <input name="iron2" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['iron2']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>MNP (6-11 months):</label>
                                                        <input name="mnp1" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['mnp1']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>MNP (12-23 months):</label>
                                                        <input name="mnp2" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['mnp2']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Deworming (12-59 months):</label>
                                                        <input name="deworming" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $row['deworming']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <a href="../nutrition2/nutrition2.php">
                                                    <button type="button" class="btn btn-default">Cancel</button>
                                                </a>
                                                <button type="submit" name="update" class="btn btn-primary">Update
                                                    client</button>
                                            </div>

                                    </form>

                                    <?php
                                    if (isset($_POST['update'])) {
                                        $reg_date = $_POST['reg_date'];
                                        $birth_date = $_POST['birth_date'];
                                        $fname = $_POST['fname'];
                                        $minitial = $_POST['minitial'];
                                        $lname = $_POST['lname'];
                                        $weight = $_POST['weight'];
                                        $height = $_POST['height'];
                                        $sex = $_POST['sex'];
                                        $age1 = $_POST['6to11mos'];
                                        $age2 = $_POST['12to59mos'];
                                        $mother_name = $_POST['mother_name'];
                                        $purok = $_POST['purok'];
                                        $address = $_POST['address'];
                                        $vitamina = $_POST['vitamina'];
                                        $vitamin1 = $_POST['vitamin1'];
                                        $vitamin2 = $_POST['vitamin2'];
                                        $iron1 = $_POST['iron1'];
                                        $iron2 = $_POST['iron2'];
                                        $mnp1 = $_POST['mnp1'];
                                        $mnp2 = $_POST['mnp2'];
                                        $deworming = $_POST['deworming'];
                                        $remarks = $_POST['remarks'];
                                        $remarks = mysqli_real_escape_string($con, $remarks);
                                        $nid2 = $_GET['nid2'];

                                        mysqli_query($con, "UPDATE nutrition2 SET reg_date='$reg_date', 
                                    birth_date='$birth_date', fname='$fname', 
                                    minitial='$minitial', lname='$lname', weight='$weight', height='$height',
                                    sex='$sex', 6to11mos='$age1', 12to59mos='$age2', mother_name='$mother_name', purok='$purok', address='$address', 
                                    vitamina='$vitamina', vitamin1='$vitamin1', vitamin2='$vitamin2', 
                                    iron1='$iron1', iron2='$iron2', mnp1='$mnp1', mnp2='$mnp2', 
                                    deworming='$deworming', remarks='$remarks' WHERE nutrition2_id = '$nid2'"); ?>

                                        <script type="text/javascript">
                                            alert("A client record has been updated.");
                                            window.location = "../nutrition2/nutrition2.php";
                                        </script>

                                        <?php
                                    }

                                    ?>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
</script>


        <?php } elseif ($_SESSION['type'] == "Nurse") {
                header("Location: ../../index.php");
            } ?>

        <!-- DataTables -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

        <?php
}
?>

</body>

</html>