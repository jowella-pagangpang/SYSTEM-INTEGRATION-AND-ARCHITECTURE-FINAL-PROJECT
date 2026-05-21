<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<head>
    <?php
    include('../headsidecss.php');
    ?>

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <title>Client Record</title>
    <link rel="icon" href="../../img/basak logo.png">

    <style>
        .form-control:focus {
            border-color: #007bff;
            /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Optional box shadow effect */
            outline: none;
            /* Remove the default focus outline if needed */
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
                            <a href="../client/client-list.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Client
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
                                <a href="../maternal/maternal.php" class="nav-link active">
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
                                <h4 class="font-weight-bold" style="font-family: Helvetica;">MATERNAL CARE</h4>
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
                                                <div class="col-5">

                                                    <h5 class="font-weight-bold">Update record</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <?php
                                            $id = $_GET['id'];
                                            $edit = mysqli_query($con, "SELECT * FROM maternal INNER JOIN client ON maternal.patientid = client.id 
                                                WHERE maternal_id = $id;");
                                            $row = mysqli_fetch_assoc($edit); ?>


                                            <div>
                                                <input name="maternal_id" type="hidden"
                                                    value="<?php echo $row['maternal_id']; ?>">
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Client ID:</label>
                                                    <input name="patientid" class="form-control form-control-sm"
                                                        type="number" value="<?php echo $row['patientid']; ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>STI Surveillance</label><br>
                                                </div>
                                                <?php
                                                $syd = $row['sydate'];
                                                $syr = $row['syresult'];
                                                $syrd = $row['syresult_date'];
                                                $gp = $row['given_penicillin'];
                                                $gpd = $row['given_penicillin_date'];
                                                $readonly1 = ($syd === '0000-00-00') ? '' : 'readonly';
                                                $readonly2 = ($syr === '(+)' || $syr === '(-)') ? '' : 'readonly';
                                                $readonly3 = ($syrd === '0000-00-00') ? '' : 'readonly';
                                                $readonly4 = ($gp === 'Y' || $gp === 'N') ? '' : 'readonly';
                                                $readonly5 = ($gpd === '0000-00-00') ? '' : 'readonly';
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Tested for SY:</label>
                                                            <input name="sydate" class="form-control form-control-sm"
                                                                type="date" value="<?php echo $syd; ?>" <?php echo $readonly1; ?>>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Result for SY Testing:</label>

                                                            <?php
                                                            $selectedValues = $row['syresult'];
                                                            if (isset($selectedValues) && !empty($selectedValues)) {
                                                                // If there is an existing selected value
                                                                echo '<div class="readonly-dropdown">';
                                                                echo '<select name="syresult" class="form-control form-control-sm" readonly>';
                                                                echo '<option value="' . $selectedValues . '" selected>' . $selectedValues . '</option>';
                                                                echo '</select>';
                                                                echo '</div>';
                                                            } else {
                                                                // If there is no existing selected value
                                                                echo '<select name="syresult" class="form-control form-control-sm">';
                                                                echo '<option value="" selected>+/-</option>';
                                                                echo '<option value="(+)">(+)</option>';
                                                                echo '<option value="(-)">(-)</option>';
                                                                echo '</select>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date:</label>
                                                            <input name="syresult_date" class="form-control form-control-sm"
                                                                type="date" value="<?php echo $syrd; ?>" <?php echo $readonly3; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Given Penicillin:</label>
                                                            <?php
                                                            $selectedValue = $row['given_penicillin'];
                                                            if (isset($selectedValue) && !empty($selectedValue)) {
                                                                // If there is an existing selected value
                                                                echo '<div class="readonly-dropdown">';
                                                                echo '<select name="given_penicillin" class="form-control form-control-sm" style="width: 100%;" readonly>';
                                                                echo '<option value="' . $selectedValue . '" selected>' . $selectedValue . '</option>';
                                                                echo '</select>';
                                                                echo '</div>';
                                                            } else {
                                                                // If there is no existing selected value
                                                                echo '<select name="given_penicillin" class="form-control form-control-sm" style="width: 100%;">';
                                                                echo '<option value="" selected>Y/N</option>';
                                                                echo '<option value="Y">Y</option>';
                                                                echo '<option value="N">N</option>';
                                                                echo '</select>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date:</label>
                                                            <input name="given_penicillin_date"
                                                                class="form-control form-control-sm" type="date"
                                                                value="<?php echo $gpd; ?>" <?php echo $readonly5; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="modal-footer">
                                            <a href="maternal-record.php?id=<?php echo $row['patientid']; ?>">
                                                <button type="button" class="btn btn-default">Cancel</button>
                                            </a>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
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
            $maternal_id = $_POST['maternal_id'];
            $patientid = $_POST['patientid'];
            $sydate = $_POST['sydate'];
            $syresult = $_POST['syresult'];
            $syresult_date = $_POST['syresult_date'];
            $given_penicillin = $_POST['given_penicillin'];
            $given_penicillin_date = $_POST['given_penicillin_date'];

            mysqli_query($con, "UPDATE maternal SET patientid='$patientid', sydate='$sydate',
            syresult='$syresult', syresult_date='$syresult_date', given_penicillin='$given_penicillin', 
            given_penicillin_date='$given_penicillin_date' WHERE maternal_id = '$id'"); ?>

            <script type="text/javascript">
                window.location = "maternal-record.php?id=<?php echo $row['patientid']; ?>";
            </script>

            <?php
        }
        ?>



        <script>
            function validateInput(inputElement) {
                let inputValue = inputElement.value;
                let lettersOnly = inputValue.replace(/[^a-zA-Z\s.-]/g, '');

                if (inputValue !== lettersOnly) {
                    let selectionStart = inputElement.selectionStart;
                    let selectionEnd = inputElement.selectionEnd;

                    inputElement.value = lettersOnly;

                    inputElement.setSelectionRange(selectionStart, selectionEnd);
                }
            }



        </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>