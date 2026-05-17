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

        <title>Client Record</title>
        <link rel="icon" href="../../img/logo.png">

        <!-- Include iCheck CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.css">
        <!-- Include jQuery (required for iCheck) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include iCheck JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>

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
                                        <a href="../nutrition2/nutrition2.php" class="nav-link active">
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
                                    <div class="col-11">
                                        <h4 class="font-weight-bold" style="font-family: Helvetica;">NUTRITION AND
EXPANDED PROGRAM FOR IMMUNIZATION PART II</h4>
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <section class="content text-sm" style="font-family: Helvetica;">
                            <div class="row">
                            <div class="col-3">
                            </div>

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
                                        $edit = mysqli_query($con, "SELECT * FROM nutrition2 INNER JOIN client ON nutrition2.patientid = client.id 
WHERE nutrition2_id = $id;");
                                        $row = mysqli_fetch_assoc($edit); ?>


                <div>
                    <input name="nutrition2_id" type="hidden"
                        value="<?php echo $row['nutrition2_id']; ?>">
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Client ID:</label>
                        <input name="patientid" class="form-control form-control-sm"
                            type="number" value="<?php echo $row['patientid']; ?>" readonly>
                    </div>
                </div>

                            <!-- 6-11 months -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age:<br></label>
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="checkbox1" value="✓" name="6to11mos"
                                        <?php if ($row['6to11mos'] == "✓")
                                            echo 'checked'; ?>>
                                        <label for="checkbox1">6-11 months</label>
                                    </div>
                                </div>
                            </div>


                            <!-- 12-59 months -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="checkbox2" value="✓" name="12to59mos" 
                                        <?php if ($row['12to59mos'] == "✓")
                                            echo 'checked'; ?>>
                                        <label for="checkbox2">12-59 months</label>
                                    </div>
                                </div>
                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker1" style="display: none;">
        <?php
        $vitamin = $row['vitamina'];
        $iron1st = $row['iron1'];
        $mnp1st = $row['mnp1'];
        $readonly1 = ($vitamin === '0000-00-00') ? '' : 'readonly';
        $readonly2 = ($iron1st === '0000-00-00') ? '' : 'readonly';
        $readonly3 = ($mnp1st === '0000-00-00') ? '' : 'readonly';
        ?>
                                                <div style="text-align: center;">
                                                    <label>Micronutrient Supplementation</label><br>
                                                </div>
                                                    <label>Vitamin A:</label>
                                                    <input name="vitamina" class="form-control form-control-sm" type="date"
                                                    id="datepicker1_input" value="<?php echo $vitamin; ?>" <?php echo $readonly1; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker2" style="display: none;">
                                                    <label>Iron:</label>
                                                    <input name="iron1" class="form-control form-control-sm" type="date"
                                                    id="datepicker2_input" value="<?php echo $iron1st; ?>" <?php echo $readonly2; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker3" style="display: none;">
                                                    <label>MNP:</label>
                                                    <input name="mnp1" class="form-control form-control-sm" type="date"
                                                    id="datepicker3_input" value="<?php echo $mnp1st; ?>" <?php echo $readonly3; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker9" style="display: none;">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks1" class="form-control form-control-sm"
                                                    id="datepicker9_input" rows="2"><?php echo $row['remarks1']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker4" style="display: none;">
        <?php
        $vit1 = $row['vitamin1'];
        $vit2 = $row['vitamin2'];
        $iron2nd = $row['iron2'];
        $mnp2nd = $row['mnp2'];
        $deworm = $row['deworming'];
        $readonly1 = ($vit1 === '0000-00-00') ? '' : 'readonly';
        $readonly2 = ($vit2 === '0000-00-00') ? '' : 'readonly';
        $readonly3 = ($iron2nd === '0000-00-00') ? '' : 'readonly';
        $readonly4 = ($mnp2nd === '0000-00-00') ? '' : 'readonly';
        $readonly5 = ($deworm === '0000-00-00') ? '' : 'readonly';
        ?>

                                                    <div style="text-align: center;">
                                                        <label>Micronutrient Supplementation</label><br>
                                                    </div>
                                                    <label>Vitamin A (Dose 1):</label>
                                                    <input name="vitamin1" class="form-control form-control-sm" type="date"
                                                    id="datepicker4_input" value="<?php echo $vit1; ?>" <?php echo $readonly1; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker5" style="display: none;">
                                                    <label>Vitamin A (Dose 2):</label>
                                                    <input name="vitamin2" class="form-control form-control-sm" type="date"
                                                    id="datepicker5_input" value="<?php echo $vit2; ?>" <?php echo $readonly2; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker6" style="display: none;">
                                                    <label>Iron:</label>
                                                    <input name="iron2" class="form-control form-control-sm" type="date"
                                                    id="datepicker6_input" value="<?php echo $iron2nd; ?>" <?php echo $readonly3; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker7" style="display: none;">
                                                    <label>MNP:</label>
                                                    <input name="mnp2" class="form-control form-control-sm" type="date"
                                                    id="datepicker7_input" value="<?php echo $mnp2nd; ?>" <?php echo $readonly4; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker8" style="display: none;">
                                                    <label>Deworming:</label>
                                                    <input name="deworming" class="form-control form-control-sm" type="date"
                                                    id="datepicker8_input" value="<?php echo $deworm; ?>" <?php echo $readonly5; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="datepicker10" style="display: none;">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control form-control-sm"
                                                    id="datepicker10_input" rows="2"><?php echo $row['remarks']; ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        </div>


                                        <div class="modal-footer">
                                            <a href="nutrition2-record.php?id=<?php echo $row['patientid']; ?>">
                                                <button type="button" class="btn btn-default">Cancel</button>
                                            </a>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </div>

                                </form>

                                <?php
                                if (isset($_POST['update'])) {
                                    $id = $_GET['id'];
                                    $nutrition2_id = $_POST['nutrition2_id'];
                                    $patientid = $_POST['patientid'];
                                    $age1 = isset($_POST['6to11mos']) ? $_POST['6to11mos'] : '';
                                    $age2 = isset($_POST['12to59mos']) ? $_POST['12to59mos'] : '';
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
                                    $remarks1 = $_POST['remarks1'];
                                    $remarks1 = mysqli_real_escape_string($con, $remarks1);

                                    mysqli_query($con, "UPDATE nutrition2 SET patientid='$patientid', 
6to11mos='$age1', 12to59mos='$age2', vitamina='$vitamina', vitamin1='$vitamin1', vitamin2='$vitamin2', 
iron1='$iron1', iron2='$iron2', mnp1='$mnp1', mnp2='$mnp2', 
deworming='$deworming', remarks='$remarks', remarks1='$remarks1' WHERE nutrition2_id = '$id'"); ?>

        
                                                        <script type="text/javascript">
                                                            window.location = "nutrition2-record.php?id=<?php echo $row['patientid']; ?>";
                                                        </script>

                                                                    <?php
                                }

                                ?>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    <div class="col-3">
                    </div>

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

$(document).ready(function () {
    // Initialize iCheck checkboxes
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
    });

    // Function to show/hide date pickers based on checkbox state
    function updateDatePickers() {
        // Hide all date pickers by default
        $('.datepicker-input').hide();

        if ($('#checkbox1').is(':checked')) {
            $('#datepicker1').show();
            $('#datepicker2').show();
            $('#datepicker3').show();
            $('#datepicker9').show();
            $('#checkbox2').iCheck('disable'); // Disable checkbox2
        } else {
            $('#checkbox2').iCheck('enable'); // Enable checkbox2
        }

        if ($('#checkbox2').is(':checked')) {
            $('#datepicker4').show();
            $('#datepicker5').show();
            $('#datepicker6').show();
            $('#datepicker7').show();
            $('#datepicker8').show();
            $('#datepicker10').show();
            $('#checkbox1').iCheck('disable'); // Disable checkbox1
        } else {
            $('#checkbox1').iCheck('enable'); // Enable checkbox1
        }
    }

    // Initial update of date pickers and checkboxes based on checkbox state
    updateDatePickers();

    // Handle Checkbox 1 change
    $('#checkbox1').on('ifChanged', function () {
        if (this.checked) {
            $('#checkbox2').iCheck('uncheck');
        }
        updateDatePickers();
    });

    // Handle Checkbox 2 change
    $('#checkbox2').on('ifChanged', function () {
        if (this.checked) {
            $('#checkbox1').iCheck('uncheck');
        }
        updateDatePickers();
    });

    // Initialize Date Pickers
    $('.datepicker-input').datepicker();
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