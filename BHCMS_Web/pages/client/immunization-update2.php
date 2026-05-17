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
    <link rel="icon" href="../../img/logo.png">

    <style>
        .form-control:focus {
            border-color: #007bff;
            /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Optional box shadow effect */
            outline: none;
            /* Remove the default focus outline if needed */
        }

        #bcgDiv {
            display: none;
        }

        #hepaDiv {
            display: none;
        }

        #pentaDiv {
            display: none;
        }

        #opvDiv {
            display: none;
        }

        #pcvDiv {
            display: none;
        }

        #ipvDiv {
            display: none;
        }

        #mmrDiv {
            display: none;
        }
        
        #ficDiv {
            display: none;
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
                                            <a href="../immunization/immunization.php" class="nav-link active">
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
                                    <div class="col-12">
                                        <h4 class="font-weight-bold" style="font-family: Helvetica;">IMMUNIZATION AND NUTRITION
                                            SERVICES FOR 0-12 MONTHS OLD</h4>
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

                                                            <h5 class="font-weight-bold">Add Immunization</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">

                                                    <?php
                                                    $id = $_GET['id'];
                                                    $edit = mysqli_query($con, "SELECT * FROM immunization INNER JOIN client 
                                            ON immunization.patientid = client.id WHERE patientid = $id;");
                                                    $row = mysqli_fetch_assoc($edit); ?>


                                                    <div>
                                                        <input name="immunization_id" type="hidden"
                                                            value="<?php echo $row['immunization_id']; ?>">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Client ID:</label>
                                                            <input name="patientid" class="form-control form-control-sm"
                                                                type="number" value="<?php echo $row['patientid']; ?>" readonly>
                                                        </div>
                                                    </div>

                            
                                                    <div class="col-md-12">
                                                <label>Immunization:</label>
                                                    <div class="form-group">
                                                        <select name="immunization" id="immunization" class="form-control form-control-sm" style="width: 100%;">
                                                            <option selected disabled value="">Select Vaccine</option>
                                                            <option value="bcg">BCG</option>
                                                            <option value="hepab">HEPA B-BD</option>
                                                            <option value="penta">DPT-HiB-HepB</option>
                                                            <option value="opv">OPV</option>
                                                            <option value="pcv">PCV</option>
                                                            <option value="ipv">IPV</option>
                                                            <option value="mmr">MMR</option>
                                                            <option value="fic">FIC</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?php
                                                $b = $row['bcg'];
                                                $hepa = $row['hepab'];
                                                $readonly1 = ($b === '0000-00-00') ? '' : 'readonly';
                                                $readonly2 = ($hepa === '0000-00-00') ? '' : 'readonly';
                                                ?>
                                                <div id="bcgDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>BCG:</label>
                                                        <input name="bcg" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $b; ?>" <?php echo $readonly1; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks']; ?></textarea>
                                                    </div>
                                                </div>
                </div>
                </div>

                                                <div id="hepaDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Hepa B-BD:</label>
                                                        <input name="hepab" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $hepa; ?>" <?php echo $readonly2; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks1" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks1']; ?></textarea>
                                                    </div>
                                                </div>
                </div>
                </div>

                                                <?php
                                                $dpt1 = $row['dpt_hib_hepb_1stdose'];
                                                $dpt2 = $row['dpt_hib_hepb_2nddose'];
                                                $dpt3 = $row['dpt_hib_hepb_3rddose'];
                                                $readonly3 = ($dpt1 === '0000-00-00') ? '' : 'readonly';
                                                $readonly4 = ($dpt2 === '0000-00-00') ? '' : 'readonly';
                                                $readonly5 = ($dpt3 === '0000-00-00') ? '' : 'readonly';
                                                ?>
                            <div id="pentaDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                <div class="row"> 
                                                <div class="col-md-12">
                                                    <label>DPT-HIB-HepB</label>
                                                    <div class="form-group">
                                                        <label>1st dose:</label>
                                                        <input name="dpt_hib_hepb_1stdose" class="form-control form-control-sm"
                                                            type="date" value="<?php echo $dpt1; ?>" <?php echo $readonly3; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>2nd dose:</label>
                                                        <input name="dpt_hib_hepb_2nddose" class="form-control form-control-sm"
                                                            type="date" value="<?php echo $dpt2; ?>" <?php echo $readonly4; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>3rd dose:</label>
                                                        <input name="dpt_hib_hepb_3rddose" class="form-control form-control-sm"
                                                            type="date" value="<?php echo $dpt3; ?>" <?php echo $readonly5; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks2" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks2']; ?></textarea>
                                                    </div>
                                                </div>
                                </div>
                            </div>

                            <?php
                            $opv1 = $row['opv_1stdose'];
                            $opv2 = $row['opv_2nddose'];
                            $opv3 = $row['opv_3rddose'];
                            $readonly6 = ($opv1 === '0000-00-00') ? '' : 'readonly';
                            $readonly7 = ($opv2 === '0000-00-00') ? '' : 'readonly';
                            $readonly8 = ($opv3 === '0000-00-00') ? '' : 'readonly';
                            ?>
                            <div id="opvDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                <div class="row"> 
                                                <div class="col-md-12">
                                                    <label>OPV</label>
                                                    <div class="form-group">
                                                        <label>1st dose:</label>
                                                        <input name="opv_1stdose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $opv1; ?>" <?php echo $readonly6; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>2nd dose:</label>
                                                        <input name="opv_2nddose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $opv2; ?>" <?php echo $readonly7; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>3rd dose:</label>
                                                        <input name="opv_3rddose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $opv3; ?>" <?php echo $readonly8; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks3" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks3']; ?></textarea>
                                                    </div>
                                                </div>
                                </div>
                            </div>

                            <?php
                            $pcv1 = $row['pcv_1stdose'];
                            $pcv2 = $row['pcv_2nddose'];
                            $pcv3 = $row['pcv_3rddose'];
                            $readonly9 = ($pcv1 === '0000-00-00') ? '' : 'readonly';
                            $readonly10 = ($pcv2 === '0000-00-00') ? '' : 'readonly';
                            $readonly11 = ($pcv3 === '0000-00-00') ? '' : 'readonly';
                            ?>
                            <div id="pcvDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                <div class="row"> 
                                            <div class="col-md-12">
                                                    <label>PCV</label>
                                                    <div class="form-group">
                                                        <label>1st dose:</label>
                                                        <input name="pcv_1stdose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $pcv1; ?>" <?php echo $readonly9; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>2nd dose:</label>
                                                        <input name="pcv_2nddose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $pcv2; ?>" <?php echo $readonly10; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>3rd dose:</label>
                                                        <input name="pcv_3rddose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $pcv3; ?>" <?php echo $readonly11; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks4" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks4']; ?></textarea>
                                                    </div>
                                                </div>
                                </div>
                            </div>

                            <?php
                            $i = $row['ipv'];
                            $readonly12 = ($i === '0000-00-00') ? '' : 'readonly';
                            ?>
                                                <div id="ipvDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                    <label>IPV</label>
                                                    <div class="form-group">
                                                        <input name="ipv" class="form-control form-control-sm" type="date"
                                                        value="<?php echo $i; ?>" <?php echo $readonly12; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks5" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks5']; ?></textarea>
                                                    </div>
                                                </div>
                </div>
                </div>
                                        
                            <?php
                            $mmr1 = $row['mmr1stdose'];
                            $mmr2 = $row['mmr2nddose'];
                            $readonly13 = ($mmr1 === '0000-00-00') ? '' : 'readonly';
                            $readonly14 = ($mmr2 === '0000-00-00') ? '' : 'readonly';
                            ?>
                            <div id="mmrDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                <div class="row"> 
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>MMR dose 1:</label>
                                                        <input name="mmr1stdose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $mmr1; ?>" <?php echo $readonly13; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>MMR dose 2:</label>
                                                        <input name="mmr2nddose" class="form-control form-control-sm" type="date"
                                                            value="<?php echo $mmr2; ?>" <?php echo $readonly14; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks6" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks6']; ?></textarea>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                    
                            <?php
                            $fic = $row['fic_date'];
                            $readonly15 = ($fic === '0000-00-00') ? '' : 'readonly';
                            ?>
                            <div id="ficDiv" class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Date Immunization Received</label><br>
                                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                                    <label>FIC</label>
                                                    <div class="form-group">
                                                        <input name="fic_date" class="form-control form-control-sm" type="date"
                                                        value="<?php echo $fic; ?>" <?php echo $readonly15; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks7" class="form-control form-control-sm"
                                                            rows="2"><?php echo $row['remarks7']; ?></textarea>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>

                                                </div>


                                                <div class="modal-footer">
                                                    <a href="immunization-record.php?id=<?php echo $row['patientid']; ?>">
                                                        <button type="button" class="btn btn-default">Cancel</button>
                                                    </a>
                                                    <button type="submit" name="update" class="btn btn-primary">Add</button>
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

                    $immunization_id = $_POST['immunization_id'];
                    $patientid = $_POST['patientid'];
                    $bcg = $_POST['bcg'];
                    $hepab = $_POST['hepab'];
                    $dpt_hib_hepb_1stdose = $_POST['dpt_hib_hepb_1stdose'];
                    $dpt_hib_hepb_2nddose = $_POST['dpt_hib_hepb_2nddose'];
                    $dpt_hib_hepb_3rddose = $_POST['dpt_hib_hepb_3rddose'];
                    $opv_1stdose = $_POST['opv_1stdose'];
                    $opv_2nddose = $_POST['opv_2nddose'];
                    $opv_3rddose = $_POST['opv_3rddose'];
                    $pcv_1stdose = $_POST['pcv_1stdose'];
                    $pcv_2nddose = $_POST['pcv_2nddose'];
                    $pcv_3rddose = $_POST['pcv_3rddose'];
                    $ipv = $_POST['ipv'];
                    $mmr1stdose = $_POST['mmr1stdose'];
                    $mmr2nddose = $_POST['mmr2nddose'];
                    $fic_date = $_POST['fic_date'];
                    $remarks = $_POST['remarks'];
                    $remarks = mysqli_real_escape_string($con, $remarks);
                    $remarks1 = $_POST['remarks1'];
                    $remarks1 = mysqli_real_escape_string($con, $remarks1);
                    $remarks2 = $_POST['remarks2'];
                    $remarks2 = mysqli_real_escape_string($con, $remarks2);
                    $remarks3 = $_POST['remarks3'];
                    $remarks3 = mysqli_real_escape_string($con, $remarks3);
                    $remarks4 = $_POST['remarks4'];
                    $remarks4 = mysqli_real_escape_string($con, $remarks4);
                    $remarks5 = $_POST['remarks5'];
                    $remarks5 = mysqli_real_escape_string($con, $remarks5);
                    $remarks6 = $_POST['remarks6'];
                    $remarks6 = mysqli_real_escape_string($con, $remarks6);
                    $remarks7 = $_POST['remarks7'];
                    $remarks7 = mysqli_real_escape_string($con, $remarks7);

                    mysqli_query($con, "UPDATE immunization SET patientid='$patientid', bcg='$bcg', 
            hepab='$hepab', dpt_hib_hepb_1stdose='$dpt_hib_hepb_1stdose', dpt_hib_hepb_2nddose='$dpt_hib_hepb_2nddose', 
            dpt_hib_hepb_3rddose='$dpt_hib_hepb_3rddose', opv_1stdose='$opv_1stdose', opv_2nddose='$opv_2nddose', opv_3rddose='$opv_3rddose', 
            pcv_1stdose='$pcv_1stdose', pcv_2nddose='$pcv_2nddose', pcv_3rddose='$pcv_3rddose', 
            ipv='$ipv', mmr1stdose='$mmr1stdose', mmr2nddose='$mmr2nddose', fic_date='$fic_date', 
            remarks='$remarks', remarks1='$remarks1', remarks2='$remarks2', remarks3='$remarks3', remarks4='$remarks4', 
            remarks5='$remarks5', remarks6='$remarks6', remarks7='$remarks7' WHERE patientid = '$patientid'"); ?>

                            <script type="text/javascript">
                                window.location = "immunization-record.php?id=<?php echo $row['patientid']; ?>";
                            </script>

                            <?php
                }
                ?>



                <script>
                    $(document).ready(function () {
                        $('#todoCheck3').on('change', function () {
                            if ($(this).is(':checked')) {
                                $('#todoCheck4').prop('checked', false);
                            }
                        });

                        $('#todoCheck4').on('change', function () {
                            if ($(this).is(':checked')) {
                                $('#todoCheck3').prop('checked', false);
                            }
                        });
                    });

                    function validateInput(inputElement) {
                        let inputValue = inputElement.value;
                        let lettersOnly = inputValue.replace(/[^a-zA-Z\s.]/g, '');

                        if (inputValue !== lettersOnly) {
                            let selectionStart = inputElement.selectionStart;
                            let selectionEnd = inputElement.selectionEnd;

                            inputElement.value = lettersOnly;


                            inputElement.setSelectionRange(selectionStart, selectionEnd);
                        }
                    }

                    // disable date
                    const datePickers = document.querySelectorAll(".date-picker");

                    datePickers.forEach(function (datePicker) {
                        if (datePicker.value) {
                            datePicker.disabled = true;
                        }
                    });



                const immunizationSelect = document.getElementById('immunization');
                const bcgDiv = document.getElementById('bcgDiv');
                const hepaDiv = document.getElementById('hepaDiv');
                const pentaDiv = document.getElementById('pentaDiv');
                const opvDiv = document.getElementById('opvDiv');
                const pcvDiv = document.getElementById('pcvDiv');
                const ipvDiv = document.getElementById('ipvDiv');
                const mmrDiv = document.getElementById('mmrDiv');
                const ficDiv = document.getElementById('ficDiv');


                immunizationSelect.addEventListener('change', function() {
                  if (immunizationSelect.value === 'bcg') {
                    bcgDiv.style.display = 'block';
                  } else {
                    bcgDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'hepab') {
                    hepaDiv.style.display = 'block';
                  } else {
                    hepaDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'penta') {
                    pentaDiv.style.display = 'block';
                  } else {
                    pentaDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'opv') {
                    opvDiv.style.display = 'block';
                  } else {
                    opvDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'pcv') {
                    pcvDiv.style.display = 'block';
                  } else {
                    pcvDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'ipv') {
                    ipvDiv.style.display = 'block';
                  } else {
                    ipvDiv.style.display = 'none';
                  }

                  if (immunizationSelect.value === 'mmr') {
                    mmrDiv.style.display = 'block';
                  } else {
                    mmrDiv.style.display = 'none';
                  }
          
                  if (immunizationSelect.value === 'fic') {
                    ficDiv.style.display = 'block';
                  } else {
                    ficDiv.style.display = 'none';
                  }
                });

                </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>