<!DOCTYPE html>
<html lang="en">

<?php
error_reporting();
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

                <title>Nutrition and EPI Part I</title>
                <link rel="icon" href="../../img/logo.png">

            <style>
            .form-control:focus {
                border-color: #007bff; /* Change to the desired highlight color */
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
                outline: none; /* Remove the default focus outline if needed */
            }

              #ttdateDiv {
                display: none;
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
              #ipvDiv {
                display: none;
              }
              #mcvDiv {
                display: none;
              }
              #firstDiv {
                display: none;
              }
              #secondDiv {
                display: none;
              }
              #thirdDiv {
                display: none;
              }
              #fourthDiv {
                display: none;
              }
              #fifthDiv {
                display: none;
              }
              #sixthDiv {
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
                                <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
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
                                                <a href="../nutrition1/nutrition1.php" class="nav-link active">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Nutrition and EPI Program I</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../nutrition2/nutrition2.php" class="nav-link">
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
                                                    <p> Client Report</p>
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

                                                <form method="post">
                                                    <div class="card-body d-flex flex-column">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-5">

                                                                    <h5 class="font-weight-bold">Update client record</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">

                                                        <?php
                                                        $nid1 = $_GET['nid1'];
                                                        $edit = mysqli_query($con, "SELECT * FROM nutrition1 WHERE nutrition1_id = '$nid1'");
                                                        $row = mysqli_fetch_assoc($edit);

                                                        // Fetch the list of maternal names
                                                        $query = "SELECT DISTINCT CONCAT(fname, ' ', minitial, ' ', lname) AS fullname FROM maternal";
                                                        $result = mysqli_query($con, $query);
                                                        $options = [];
                                                        if ($result) {
                                                            while ($name_row = mysqli_fetch_assoc($result)) {
                                                                $options[] = $name_row;
                                                            }
                                                            mysqli_free_result($result);
                                                        }
                                                        ?>


                                                            <div>
                                                                <input type="hidden" name="nutrition1_id"
                                                                    value="<?php echo $row['nutrition1_id']; ?>">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Date of Registration:</label>
                                                                    <input name="reg_date" id="reg_date" class="form-control form-control-sm date-picker" type="date"
                                                                    value="<?php echo $row['reg_date']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Date of Birth:</label>
                                                                    <input name="birth_date" id="birth_date" class="form-control form-control-sm date-picker" type="date"
                                                                        value="<?php echo $row['birth_date']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label>Name of Child:</label>
                                                                    <input name="fname" type="text" class="form-control form-control-sm"
                                                                        value="<?php echo $row['fname']; ?>" 
                                                                        oninput="validateInput(this)">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label><br></label>
                                                                    <input name="minitial" type="text" class="form-control form-control-sm"
                                                                        value="<?php echo $row['minitial']; ?>" 
                                                                        oninput="validateInput(this)">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label><br></label>
                                                                    <input name="lname" type="text" class="form-control form-control-sm"
                                                                        value="<?php echo $row['lname']; ?>" 
                                                                        oninput="validateInput(this)">
                                                                </div>
                                                            </div>


                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Weight:<br></label>
                                                                    <input name="weight" class="form-control form-control-sm" type="number"
                                                                        value="<?php echo $row['weight']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Height:<br></label>
                                                                    <input name="height" class="form-control form-control-sm" type="number"
                                                                        value="<?php echo $row['height']; ?>">
                                                                </div>
                                                            </div>
                                                
                                                            <div class="col-md-6">
                                                            <label>Sex: </label>
                                                            <div class="form-group">
                                                                <div class="icheck-primary">
                                                                    <input type="radio" name="sex" value="M" id="radioPrimary1"
                                                                    <?php if ($row['sex'] == "M")
                                                                        echo 'checked'; ?>>
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
                                                                    <?php if ($row['sex'] == "F")
                                                                        echo 'checked'; ?>>
                                                                    <label for="radioPrimary2">
                                                                        <span class="text" style="font-weight: normal;">
                                                                            Female
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                            <!--
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Sex:<br></label>
                                                            <select name="sex" class="form-control form-control-sm" style="width: 100%;"
                                                                required>
                                                                <option selected>
                                                                    <?php echo $row['sex']; ?>
                                                                </option>
                                                                <option value="M">M</option>
                                                                <option value="F">F</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        -->

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name of Mother:</label>
                                                        <select name="selected_mother_name" id="mother_name" class="form-control form-control-sm" style="width: 100%;">
                                                            <option selected><?php echo $row['mother_name']; ?></option>
                                                            <?php
                                                            foreach ($options as $name) {
                                                                echo '<option value="' . $name['fullname'] . '">' . $name['fullname'] . '</option>';
                                                            }
                                                            ?>
                                                            <option value="others">Other</option>
                                                        </select>
                                                        <input type="text" id="new_name_input" name="new_mother_name" class="form-control form-control-sm" 
                                                        style="display: none;" value="<?php echo $row['mother_name']; ?>">
                                                    </div>
                                                </div>



                                                        <div class="col-md-6">
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
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><br></label>
                                                                    <input name="address" class="form-control form-control-sm" type="text"
                                                                        value="<?php echo $row['address']; ?>" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label>Date Newborn Screening</label>
                                                                <div class="form-group">
                                                                    <label>Done:</label>
                                                                    <input name="screening_done" id="screening_done" class="form-control form-control-sm date-picker"
                                                                        type="date" value="<?php echo $row['screening_done']; ?>">
                                                                </div>
                                                            </div>

                        <div class="col-md-12">
                            <label>Child Protected at Birth</label>
                            <div class="form-group">
                                <label>TT Status:</label>
                                <select name="tetanus_status" id="cpab" class="form-control form-control-sm" style="width: 100%;">
                                    <option value="<?php echo $row['tetanus_status']; ?>"><?php echo $row['tetanus_status']; ?></option>
                                    <option value="TT1">TT1</option>
                                    <option value="TT2">TT2</option>
                                    <option value="TT3">TT3</option>
                                    <option value="TT4">TT4</option>
                                    <option value="TT5">TT5</option>
                                    <option value="FIM">Fully Immunized Mother (FIM)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            <div class="row"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Date:</label>
                                        <input name="date_ttstatus" class="form-control form-control-sm" type="date" value="<?php echo $row['date_ttstatus']; ?>" placeholder="Date">
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Date Assess:</label>
                                        <input name="date_assess" class="form-control form-control-sm" type="date" value="<?php echo $row['date_assess']; ?>" placeholder="Date Assess">
                                    </div>
                                </div>
                            </div>
                        </div>



                    <div class="col-md-12">
                        <label>Date Immunization Received</label>
                            <div class="form-group">
                                <select name="immunization" id="immunization" class="form-control form-control-sm" style="width: 100%;">
                                    <option selected disabled value="">Select Immunization</option>
                                    <option value="bcg">BCG</option>
                                    <option value="hepab">HEPA B1 (within 24 hours)</option>
                                    <option value="penta">Pentavalent</option>
                                    <option value="opv">OPV</option>
                                    <option value="ipv">IPV</option>
                                    <option value="mcv">MCV</option>
                                </select>
                            </div>
                        </div>

                        <div id="bcgDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>BCG:</label>
                                                    <input name="bcg" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['bcg']; ?>">
                                                </div>
                                            </div>

                                            <div id="hepaDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>HEPA B1 (within 24 hours):</label>
                                                    <input name="hepab1" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['hepab1']; ?>">
                                                </div>
                                            </div>

                                        <div id="pentaDiv" class="col-md-12">
                                            <div class="row"> 
                                            <div class="col-md-4">
                                                <label>Pentavalent<br></label>
                                                <div class="form-group">
                                                    <label>1:</label>
                                                    <input name="pentavalent1st" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $row['pentavalent1st']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label><br></label>
                                                <div class="form-group">
                                                    <label>2:</label>
                                                    <input name="pentavalent2nd" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $row['pentavalent2nd']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label><br></label>
                                                <div class="form-group">
                                                    <label>3:</label>
                                                    <input name="pentavalent3rd" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $row['pentavalent3rd']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="opvDiv" class="col-md-12">
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                <label>OPV<br></label>
                                                <div class="form-group">
                                                    <label>1:</label>
                                                    <input name="opv1st" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['opv1st']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label><br></label>
                                                <div class="form-group">
                                                    <label>2:</label>
                                                    <input name="opv2nd" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['opv2nd']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label><br></label>
                                                <div class="form-group">
                                                    <label>3:</label>
                                                    <input name="opv3rd" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['opv3rd']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div id="ipvDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>IPV:</label>
                                                    <input name="ipv" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['ipv']; ?>">
                                                </div>
                                            </div>


                                    <div id="mcvDiv" class="col-md-12">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>MCV1 (AMV):</label>
                                                    <input name="mcv1" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['mcv1']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>MCV2 (MMR):</label>
                                                    <input name="mcv2" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['mcv2']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Date Fully Immunized Child (FIC)</label>
                                                                    <input name="ficdate" class="form-control form-control-sm" type="date"
                                                                        value="<?php echo $row['ficdate']; ?>">
                                                                </div>
                                                            </div>

                    <div class="col-md-12">
                        <label>Child was Breastfed</label>
                            <div class="form-group">
                                <select name="breastfed" id="breastfed" class="form-control form-control-sm" style="width: 100%;">
                                    <option selected disabled value="">Select Month</option>
                                    <option value="1mo">1st Month</option>
                                    <option value="2mo">2nd Month</option>
                                    <option value="3mo">3rd Month</option>
                                    <option value="4mo">4th Month</option>
                                    <option value="5mo">5th Month</option>
                                    <option value="6mo">6th Month</option>
                                </select>
                            </div>
                        </div>

                                            <div id="firstDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>1st Month:</label>
                                                        <input name="breastfed1st" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed1st']; ?>">
                                                </div>
                                            </div>

                                            <div id="secondDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>2nd Month:</label>
                                                        <input name="breastfed2nd" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed2nd']; ?>"">
                                </div>
                            </div>

                            <div id="thirdDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>3rd Month:</label>
                                                        <input name="breastfed3rd" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed3rd']; ?>">
                                                </div>
                                            </div>

                                            <div id="fourthDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>4th Month:</label>
                                                        <input name="breastfed4th" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed4th']; ?>">
                                                </div>
                                            </div>

                                            <div id="fifthDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>5th Month:</label>
                                                        <input name="breastfed5th" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed5th']; ?>">
                                                </div>
                                            </div>

                                            <div id="sixthDiv" class="col-md-12">
                                                <div class="form-group">
                                                    <label>6th Month:</label>
                                                        <input name="breastfed6th" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $row['breastfed6th']; ?>">
                                                </div>
                                            </div>

                                                        <div class="col-md-12">
                                                                <label>Complementary Feeding</label>
                                                                <div class="form-group">
                                                                    <label>6th Month:</label>
                                                                    <input name="complementary" class="form-control form-control-sm" type="date"
                                                                        value="<?php echo $row['complementary']; ?>">
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

                                                        <div class="modal-footer">
                                                            <a href="../nutrition1/nutrition1.php">
                                                                <button type="button" class="btn btn-default">Cancel</button>
                                                            </a>
                                                            <button type="submit" name="update" class="btn btn-primary">Update client</button>
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
                                                    if (isset($_POST['selected_mother_name']) && !empty($_POST['selected_mother_name']) && $_POST['selected_mother_name'] !== 'others') {
                                                        $mother_name = $_POST['selected_mother_name'];
                                                    } elseif (isset($_POST['new_mother_name'])) {
                                                        $mother_name = $_POST['new_mother_name'];
                                                    } else {
                                                        die("Error: No mother name provided");
                                                    }
                                                    $purok = $_POST['purok'];
                                                    $address = $_POST['address'];
                                                    $screening_done = $_POST['screening_done'];
                                                    $tetanus_status = $_POST['tetanus_status'];
                                                    $date_ttstatus = $_POST['date_ttstatus'];
                                                    $date_assess = $_POST['date_assess'];
                                                    $bcg = $_POST['bcg'];
                                                    $hepab1 = $_POST['hepab1'];
                                                    $pentavalent1st = $_POST['pentavalent1st'];
                                                    $pentavalent2nd = $_POST['pentavalent2nd'];
                                                    $pentavalent3rd = $_POST['pentavalent3rd'];
                                                    $opv1st = $_POST['opv1st'];
                                                    $opv2nd = $_POST['opv2nd'];
                                                    $opv3rd = $_POST['opv3rd'];
                                                    $ipv = $_POST['ipv'];
                                                    $mcv1 = $_POST['mcv1'];
                                                    $mcv2 = $_POST['mcv2'];
                                                    $ficdate = $_POST['ficdate'];
                                                    $breastfed1st = $_POST['breastfed1st'];
                                                    $breastfed2nd = $_POST['breastfed2nd'];
                                                    $breastfed3rd = $_POST['breastfed3rd'];
                                                    $breastfed4th = $_POST['breastfed4th'];
                                                    $breastfed5th = $_POST['breastfed5th'];
                                                    $breastfed6th = $_POST['breastfed6th'];
                                                    $complementary = $_POST['complementary'];
                                                    $remarks = $_POST['remarks'];
                                                    $remarks = mysqli_real_escape_string($con, $remarks);
                                                    $nid1 = $_GET['nid1'];

                                                    mysqli_query($con, "UPDATE nutrition1 SET reg_date='$reg_date', birth_date='$birth_date', fname='$fname', 
                                    minitial='$minitial', lname='$lname', weight='$weight', height='$height', sex='$sex', 
                                    mother_name='$mother_name', purok='$purok', address='$address', 
                                    screening_done='$screening_done', tetanus_status='$tetanus_status', date_ttstatus='$date_ttstatus', date_assess='$date_assess',   
                                    bcg='$bcg', hepab1='$hepab1', pentavalent1st='$pentavalent1st', pentavalent2nd='$pentavalent2nd', 
                                    pentavalent3rd='$pentavalent3rd', opv1st='$opv1st', opv2nd='$opv2nd', opv3rd='$opv3rd', 
                                    ipv='$ipv', mcv1='$mcv1', mcv2='$mcv2', ficdate='$ficdate', breastfed1st='$breastfed1st', breastfed2nd='$breastfed2nd', 
                                    breastfed3rd='$breastfed3rd', breastfed4th='$breastfed4th', breastfed5th='$breastfed5th', breastfed6th='$breastfed6th', 
                                     complementary='$complementary', remarks='$remarks' WHERE nutrition1_id = '$nid1'"); ?>

                                                            <script type="text/javascript">
                                                                alert("A client record has been updated.");
                                                                window.location = "../nutrition1/nutrition1.php";
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
            // add new mother name
                document.getElementById('mother_name').addEventListener('change', function() {
                if (this.value === 'others') {
                    document.getElementById('new_name_input').style.display = 'block';
                    document.getElementById('new_name_input').setAttribute('required', 'required');
                } else {
                    document.getElementById('new_name_input').style.display = 'none';
                    document.getElementById('new_name_input').removeAttribute('required');
                }
            });

        // input letters
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

                    datePickers.forEach(function(datePicker) {
                        if (datePicker.value) {
                            datePicker.disabled = true;
                        }
                    });

                    // select category
                        const cpabSelect = document.getElementById('cpab');
                        const ttdateDiv = document.getElementById('ttdateDiv');

                        const immunizationSelect = document.getElementById('immunization');
                        const bcgDiv = document.getElementById('bcgDiv');
                        const hepaDiv = document.getElementById('hepaDiv');
                        const pentaDiv = document.getElementById('pentaDiv');
                        const opvDiv = document.getElementById('opvDiv');
                        const ipvDiv = document.getElementById('ipvDiv');
                        const mcvDiv = document.getElementById('mcvDiv');

                        const breastfedSelect = document.getElementById('breastfed');
                        const firstDiv = document.getElementById('firstDiv');
                        const secondDiv = document.getElementById('secondDiv');
                        const thirdDiv = document.getElementById('thirdDiv');
                        const fourthDiv = document.getElementById('fourthDiv');
                        const fifthDiv = document.getElementById('fifthDiv');
                        const sixthDiv = document.getElementById('sixthDiv');


                        cpabSelect.addEventListener('change', function() {
                          if (cpabSelect.value === 'TT1' || cpabSelect.value === 'TT2' || cpabSelect.value === 'TT3' || 
                          cpabSelect.value === 'TT4' || cpabSelect.value === 'TT5' || cpabSelect.value === 'FIM') {
                            ttdateDiv.style.display = 'block';
                          } 
                          else {
                            ttdateDiv.style.display = 'none';
                          }
                        });

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

                          if (immunizationSelect.value === 'ipv') {
                            ipvDiv.style.display = 'block';
                          } else {
                            ipvDiv.style.display = 'none';
                          }

                          if (immunizationSelect.value === 'mcv') {
                            mcvDiv.style.display = 'block';
                          } else {
                            mcvDiv.style.display = 'none';
                          }
                        });
        
                        breastfedSelect.addEventListener('change', function() {
                          if (breastfedSelect.value === '1mo') {
                            firstDiv.style.display = 'block';
                          } else {
                            firstDiv.style.display = 'none';
                          }

                          if (breastfedSelect.value === '2mo') {
                            secondDiv.style.display = 'block';
                          } else {
                            secondDiv.style.display = 'none';
                          }

                          if (breastfedSelect.value === '3mo') {
                            thirdDiv.style.display = 'block';
                          } else {
                            thirdDiv.style.display = 'none';
                          }

                          if (breastfedSelect.value === '4mo') {
                            fourthDiv.style.display = 'block';
                          } else {
                            fourthDiv.style.display = 'none';
                          }

                          if (breastfedSelect.value === '5mo') {
                            fifthDiv.style.display = 'block';
                          } else {
                            fifthDiv.style.display = 'none';
                          }

                          if (breastfedSelect.value === '6mo') {
                            sixthDiv.style.display = 'block';
                          } else {
                            sixthDiv.style.display = 'none';
                          }
                        });
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