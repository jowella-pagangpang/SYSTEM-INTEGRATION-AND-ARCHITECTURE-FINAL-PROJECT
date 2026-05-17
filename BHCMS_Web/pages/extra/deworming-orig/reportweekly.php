<!DOCTYPE html>
<html lang="en">

<?php
error_reporting();
include('../dbcon.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $service = $_POST['service'];
  $date = $_POST['date'];
  $newDate = date("Y-m-d", strtotime($date . " +7 days"));
}
if ($service == "deworming1") {
  $title = "DEWORMING FOR 1-4 YEARS OLD";
}
if ($service == "deworming2") {
  $title = "DEWORMING FOR 5-9 YEARS OLD";
}
if ($service == "deworming3") {
  $title = "DEWORMING FOR 10-19 YEARS OLD";
}
if ($service == "immunization") {
  $title = "IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD";
}
if ($service == "nutrition1") {
  $title = "NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION PART I";
}
if ($service == "nutrition2") {
  $title = "NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION PART II";
}
if ($service == "sickchildren") {
  $title = "SICK CHILDREN";
}
if ($service == "maternal") {
  $title = "MATERNAL CARE";
}
if ($service == "postpartum") {
  $title = "POSTPARTUM CARE";
}

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

      <title>Weekly Report</title>
      <link rel="icon" href="../../img/logo.png">

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
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Report
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="../main/weekly.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Weekly Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../main/monthly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Monthly Report</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                  <a href="../main/patient.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patient Report</p>
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
              <div class="col-9">
                <h4 class="font-weight-bold" style="font-family: Helvetica;">WEEKLY REPORT</h4>
              </div>
              <div class="col-2">
              </div>
              <div class="col-1">
                <div class="form-group">
                  <a href="weekly.php" class="btn btn-secondary bg-gradient-secondary btn-block">Back</a>
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content text-sm" style="font-family: Helvetica;">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <br>
                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR
                  <?php echo $title; ?>
                </h5>

                <form method="post">
                  <div class="card-body d-flex flex-column">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-10">
                          <h6 class="font-weight-bold">from
                            <?php echo $date; ?> to
                            <?php echo $newDate; ?>
                          </h6>
                        </div>
                    <?php  if ($service == "deworming1") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="deworming1weekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "deworming2") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="deworming2weekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "deworming3") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="deworming3weekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "immunization") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="immunizationweekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "nutrition1") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="nutrition1weekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "nutrition2") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="nutrition2weekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "sickchildren") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="sickchildrenweekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "maternal") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="maternalweekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      <?php  if ($service == "postpartum") { ?>
                      <div class="col-2">
                        <div class="form-group">
                        <a href="postpartumweekly.php?date=<?php echo $date; ?>" class="btn btn-success bg-gradient-success btn-block">Weekly Report</a>
                      </div>
                      </div>
                      <?php } ?>
                      </div>
                      </div>

                      <?php
                      if ($service == "deworming1") {
                        $deworming1st = mysqli_query($con, "SELECT deworming1_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                    FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>

                          <table id="example" class="table table-bordered table-hover table-sm text-center">
                            <thead>
                              <tr>
                                <th>Date of Registration</th>
                                <th>Date of Birth</th>
                                <th>Name of <br>Child</th>
                                <th>Sex</th>
                                <th>Name of Mother</th>
                                <th>Complete <br>Address</th>
                                <th>Age</th>
                                <th>1st Dose (date given)</th>
                                <th>2nd Dose (date given)</th>
                                <th>Remarks</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($deworming1st)) { ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['birthdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['sex']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['mother_name']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['purok']; ?>, <br>
                                      <?php echo $data['address']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['age']; ?>
                                    </td>
                                          <td>
                                            <?php if ($data['1st_dose'] > 0) {
                                              echo $data['1st_dose'];
                                            } ?>
                                          </td>
                                          <td>
                                            <?php if ($data['2nd_dose'] > 0) {
                                              echo $data['2nd_dose'];
                                            }
                                            ; ?>
                                          </td>
                                    <td>
                                      <?php echo $data['remarks']; ?>
                                    </td>
                                  </tr>

                                  <?php
                              } ?>

                            </tbody>

                          </table>                      
                        </div>
                      <?php } ?>


                      <?php
                      if ($service == "deworming2") {
                        ?>

                          <?php
                          $deworming2nd = mysqli_query($con, "SELECT deworming2_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                FROM $service WHERE reg_date between '$date' AND '$newDate'");
                          ?>

                          <table id="example" class="table table-bordered table-hover table-sm text-center">
                            <thead>
                              <tr>
                                <th>Date of Registration</th>
                                <th>Date of Birth</th>
                                <th>Name of Child</th>
                                <th>Sex</th>
                                <th>Name of Mother</th>
                                <th>Complete <br>Address</th>
                                <th>Age</th>
                                <th>1st Dose (date given)</th>
                                <th>2nd Dose (date given)</th>
                                <th>Remarks</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($deworming2nd)) { ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['birthdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['sex']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['mother_name']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['purok']; ?>, <br>
                                      <?php echo $data['address']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['age']; ?>
                                    </td>
                                          <td>
                                            <?php if ($data['1st_dose'] > 0) {
                                              echo $data['1st_dose'];
                                            } ?>
                                          </td>
                                          <td>
                                            <?php if ($data['2nd_dose'] > 0) {
                                              echo $data['2nd_dose'];
                                            }
                                            ; ?>
                                          </td>
                                    <td>
                                      <?php echo $data['remarks']; ?>
                                    </td>
                                  </tr>

                              <?php } ?>
                            </tbody>
                          </table>
                      <?php } ?>





                      <?php
                      if ($service == "deworming3") {
                        ?>

                          <?php
                          $deworming3rd = mysqli_query($con, "SELECT deworming3_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                              DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                              CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                              purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                              DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                              FROM $service WHERE reg_date between '$date' AND '$newDate'");
                          ?>

                          <table id="example" class="table table-bordered table-hover table-sm text-center">
                            <thead>
                              <tr>
                                <th>Date of Registration</th>
                                <th>Date of Birth</th>
                                <th>Name of <br>Adolescent</th>
                                <th>Sex</th>
                                <th>Name of Mother</th>
                                <th>Complete <br>Address</th>
                                <th>Age</th>
                                <th>1st Dose (date given)</th>
                                <th>2nd Dose (date given)</th>
                                <th>Remarks</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($deworming3rd)) { ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['birthdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['sex']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['mother_name']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['purok']; ?>, <br>
                                      <?php echo $data['address']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['age']; ?>
                                    </td>
                                          <td>
                                            <?php if ($data['1st_dose'] > 0) {
                                              echo $data['1st_dose'];
                                            } ?>
                                          </td>
                                          <td>
                                            <?php if ($data['2nd_dose'] > 0) {
                                              echo $data['2nd_dose'];
                                            }
                                            ; ?>
                                          </td>
                                    <td>
                                      <?php echo $data['remarks']; ?>
                                    </td>
                                  </tr>
                              <?php } ?>
                            </tbody>

                          </table>

                      <?php } ?>


                      <?php
                      if ($service == "immunization") {
                        ?>

                          <div><br>
                            <ul class="nav nav-tabs font-weight-bold">
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link active" href="#page1">
                                  <i class="fa fa-file"></i> Page 1</a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page2">
                                  <i class="fa fa-file"></i> Page 2</a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page3">
                                  <i class="fa fa-file"></i> Page 3</a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page4">
                                  <i class="fa fa-file"></i> Page 4</a>
                              </li>
                            </ul>

                            <?php
                            $immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2 FROM $service WHERE reg_date between '$date' AND '$newDate'");
                            ?>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane active py-3" id="page1">
                                <table id="example" class="table table-bordered table-hover table-sm text-center"
                                  cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th rowspan="2">Date of Registration</th>
                                      <th rowspan="2">Date of Birth</th>
                                      <th rowspan="2" class="font-weight-normal"><b>SE Status</b>
                                        <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                                      </th>
                                      <th rowspan="2">Name of Child</th>
                                      <th rowspan="2">Sex</th>
                                      <th rowspan="2">Name of Mother</th>
                                      <th rowspan="2">Complete Address</th>
                                      <th colspan="2">Child Protected at Birth (CPAB)</th>
                                    </tr>
                                    <tr>
                                      <th class="font-weight-normal">TT2/Td2 given <br>to the mother <br>a month prior <br>to
                                        delivery <br>(for mothers <br>pregnant for the <br>first time)</th>
                                      <th class="font-weight-normal">TT3/Td3 <br>to TT5/Td5 <br>(or TT1/Td1 <br>to TT5/Td5)
                                        <br>given
                                        to the <br>mother <br>anytime <br>prior to <br>delivery
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($immunization)) { ?>

                                        <tr>
                                          <td>
                                            <?php echo $data['regdate']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['birthdate']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['se_status']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['fullname']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['sex']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['mother_name']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['caddress']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['cpab1']; ?>
                                          </td>
                                          <td>
                                            <?php echo $data['cpab2']; ?>
                                          </td>
                                        </tr>

                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>

                              <?php
                              $immunization = mysqli_query($con, "SELECT immunization_id, length, weight, birth_weight_status, 
                  DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
                  DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate FROM $service WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <div class="tab-pane fade py-3" id="page2">
                                <table id="example1" class="table table-bordered table-hover table-sm text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th colspan="6">NEWBORN (0-28 DAYS OLD)</th>
                                    </tr>
                                    <tr>
                                      <th rowspan="2" class="font-weight-normal"><b>Length <br>at Birth</b> <br>(cm)</th>
                                      <th rowspan="2" class="font-weight-normal"><b>Weight <br>at Birth</b> <br>(kg)</th>
                                      <th>Status <br>(Birth Weight)</th>
                                      <th rowspan="2">Initiated breast feeding <br>immediately after birth <br>lasting for 90
                                        minutes</th>
                                      <th colspan="2">Immunization</th>
                                    </tr>
                                    <tr>
                                      <th class="font-weight-normal"><b>L:</b> low: <br>
                                        <2,500 gms <br><b>N:</b> normal: <br>>2,500 gms <br><b>U:</b> unknown
                                      </th>
                                      <th>BCG</th>
                                      <th>Hepa B-BD</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    while ($data = mysqli_fetch_array($immunization)) { ?>

                                        <tr>
                                <td>
                                  <?php if($data['length']>0) {echo $data['length'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['weight']>0) {echo $data['weight'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['birth_weight_status']; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfeed']>0) {echo $data['breastfeed'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['bcgdate']>0) {echo $data['bcgdate'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['hepabdate']>0) {echo $data['hepabdate'];}; ?>
                                </td>
                                        </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>
                              </div>

                              <?php
                              $immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
                  DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
                  DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
                  DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
                  DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate FROM $service WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <div class="tab-pane fade py-3" id="page3">
                                <table id="example2" class="table table-bordered table-hover table-sm text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th colspan="10">1-3 MONTHS OLD</th>
                                    </tr>
                                    <tr>
                                      <th colspan="10">Immunization</th>
                                    </tr>
                                    <tr>
                                      <th colspan="3">DPT-HIB-HepB</th>
                                      <th colspan="3">OPV</th>
                                      <th colspan="3">PCV</th>
                                      <th>IPV</th>
                                    </tr>
                                    <tr>
                                      <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                      <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                      <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                      <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                      <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                      <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                      <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                      <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                      <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                      <th>3 mos</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    while ($data = mysqli_fetch_array($immunization)) { ?>

                                        <tr>
                                <td>
                                  <?php if($data['dpt_hib_hepb1']>0) {echo $data['dpt_hib_hepb1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['dpt_hib_hepb2']>0) {echo $data['dpt_hib_hepb2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['dpt_hib_hepb3']>0) {echo $data['dpt_hib_hepb3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv1']>0) {echo $data['opv1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv2']>0) {echo $data['opv2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv3']>0) {echo $data['opv3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['pcv1']>0) {echo $data['pcv1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['pcv2']>0) {echo $data['pcv2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['pcv3']>0) {echo $data['pcv3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['ipvdate']>0) {echo $data['ipvdate'];}; ?>
                                </td>
                                        </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>
                              </div>

                              <?php
                              $immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
                  DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
                  remarks FROM $service WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <div class="tab-pane fade py-3" id="page4">
                                <table id="example3" class="table table-bordered table-hover table-sm text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th>6-11 MONTHS OLD</th>
                                      <th colspan="2">12 MONTHS OLD</th>
                                      <th rowspan="2">Remarks</th>
                                    </tr>
                                    <tr>
                                      <th>MMR Dose 1 <br>at 9th month</th>
                                      <th>MMR Dose 2 <br>at 12th month</th>
                                      <th>FIC</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($immunization)) { ?>

                                        <tr>
                                <td>
                                  <?php if($data['mmr1']>0) {echo $data['mmr1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['mmr2']>0) {echo $data['mmr2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['fic']>0) {echo $data['fic'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['remarks']; ?>
                                </td>
                                        </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>

                            <?php } ?>

                            <?php
                            if ($service == "nutrition1") {
                              ?>
                    <br>
                        <ul class="nav nav-tabs font-weight-bold">
                          <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#page1">
                              <icon class="fa fa-file"></icon> Page 1
                            </a>
                          </li>
                          <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#page2">
                              <i class="fa fa-file"></i> Page 2</a>
                          </li>
                          <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#page3">
                              <i class="fa fa-file"></i> Page 3</a>
                          </li>
                        </ul>

                        <?php
                        $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, weight, height, sex, mother_name, 
                    purok, address, DATE_FORMAT(screening_done,'%m-%d-%Y') AS done, tetanus_status, 
                    DATE_FORMAT(date_ttstatus,'%m-%d-%Y') AS datett, DATE_FORMAT(date_assess,'%m-%d-%Y') AS assess 
                    FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active py-3" id="page1">
                            <table id="example" class="table table-bordered table-hover table-sm text-center" cellspacing="0"
                              width="100%">
                              <thead>
                                <tr>
                                  <th rowspan="2">Date of <br>Registration</th>
                                  <th rowspan="2">Date of Birth</th>
                                  <th rowspan="2">Name of Child</th>
                                  <th rowspan="2">Weight</th>
                                  <th rowspan="2">Height</th>
                                  <th rowspan="2">Sex</th>
                                  <th rowspan="2">Name of Mother</th>
                                  <th rowspan="2">Complete Address</th>
                                  <th>Date Newborn <br>Screening</th>
                                  <th colspan="2">Child Protected at Birth (CPAB)</th>
                                </tr>
                                <tr>
                                  <th>Done</th>
                                  <th>TT Status <br>/ Date</th>
                                  <th>Date Assess</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($nutrition1)) { ?>

                                    <tr>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php echo $data['birthdate']; ?>
                                </td>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                <?php if($data['weight']>0) {echo $data['weight'];}; ?>
                                </td>
                                <td>
                                <?php if($data['height']>0) {echo $data['height'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['sex']; ?>
                                </td>
                                <td>
                                  <?php echo $data['mother_name']; ?>
                                </td>
                                <td>
                                  <?php echo $data['purok']; ?>, <br>
                                  <?php echo $data['address']; ?>
                                </td>
                                <td>
                                  <?php if($data['done']>0) {echo $data['done'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['tetanus_status']; ?><br>
                                <?php if($data['datett']>0) {echo $data['datett'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['assess']>0) {echo $data['assess'];}; ?>
                                </td>
                                    </tr>
                                    <?php
                                } ?>
                              </tbody>
                            </table>
                          </div>

                          <?php
                          $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate, 
                    DATE_FORMAT(hepab1,'%m-%d-%Y') AS hepadate, DATE_FORMAT(pentavalent1st,'%m-%d-%Y') AS penta1, 
                    DATE_FORMAT(pentavalent2nd,'%m-%d-%Y') AS penta2, DATE_FORMAT(pentavalent3rd, '%m-%d-%Y') AS penta3, 
                    DATE_FORMAT(opv1st,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv2nd,'%m-%d-%Y') AS opv2, DATE_FORMAT(opv3rd,'%m-%d-%Y') AS opv3, 
                    DATE_FORMAT(ipv,'%m-%d-%Y') AS ipv1, DATE_FORMAT(mcv1,'%m-%d-%Y') AS mcv1st, DATE_FORMAT(mcv2,'%m-%d-%Y') AS mcv2nd 
                    FROM $service WHERE reg_date between '$date' AND '$newDate'");
                          ?>

                          <div class="tab-pane fade py-3" id="page2">
                            <table id="example1" class="table table-bordered table-hover table-sm text-center" width="100%">
                              <thead>
                                <tr>
                                  <th colspan="11">Date Immunization Received</th>
                                </tr>
                                <tr>
                                  <th rowspan="2">BCG</th>
                                  <th>HEPA B1</th>
                                  <th colspan="3">Pentavalent</th>
                                  <th colspan="3">OPV</th>
                                  <th rowspan="2">IPV</th>
                                  <th colspan="2">MCV</th>
                                </tr>
                                <tr>
                                  <th>Within <br>24 hours</th>
                                  <th> 1 </th>
                                  <th> 2 </th>
                                  <th> 3 </th>
                                  <th> 1 </th>
                                  <th> 2 </th>
                                  <th> 3 </th>
                                  <th>MCV1 <br>(AMV)</th>
                                  <th>MCV2 <br>(MMR)</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              while ($data = mysqli_fetch_array($nutrition1)) { ?>

                                    <tr>
                                <td>
                                  <?php if($data['bcgdate']>0) {echo $data['bcgdate'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['hepadate']>0) {echo $data['hepadate'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['penta1']>0) {echo $data['penta1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['penta2']>0) {echo $data['penta2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['penta3']>0) {echo $data['penta3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv1']>0) {echo $data['opv1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv2']>0) {echo $data['opv2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['opv3']>0) {echo $data['opv3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['ipv1']>0) {echo $data['ipv1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['mcv1st']>0) {echo $data['mcv1st'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['mcv2nd']>0) {echo $data['mcv2nd'];}; ?>
                                </td>
                                    </tr>
                                    <?php
                              } ?>
                              </tbody>
                            </table>
                          </div>

                          <?php
                          $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(ficdate,'%m-%d-%Y') AS fic, 
                    DATE_FORMAT(breastfed1st,'%m-%d-%Y') AS breastfed1, DATE_FORMAT(breastfed2nd,'%m-%d-%Y') AS breastfed2, 
                    DATE_FORMAT(breastfed3rd,'%m-%d-%Y') AS breastfed3, DATE_FORMAT(breastfed4th, '%m-%d-%Y') AS breastfed4,  
                   DATE_FORMAT(breastfed5th,'%m-%d-%Y') AS breastfed5, DATE_FORMAT(breastfed6th,'%m-%d-%Y') AS breastfed6, 
                    DATE_FORMAT(complementary,'%m-%d-%Y') AS comple, remarks FROM $service WHERE reg_date between '$date' AND '$newDate'");
                          ?>

                          <div class="tab-pane fade py-3" id="page3">
                            <table id="example2" class="table table-bordered table-hover table-sm text-center" width="100%">
                              <thead>
                                <tr>
                                  <th rowspan="2">Date Fully <br>Immunized Child <br>(FIC)</th>
                                  <th colspan="6">Child was Exclusively Breastfed</th>
                                  <th>Complementary Feeding</th>
                                  <th rowspan="2">Remarks</th>
                                </tr>
                                <tr>
                                  <th>1st MO</th>
                                  <th>2nd MO</th>
                                  <th>3rd MO</th>
                                  <th>4th MO</th>
                                  <th>5th MO</th>
                                  <th>6th MO</th>
                                  <th>6th MO</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              while ($data = mysqli_fetch_array($nutrition1)) { ?>

                                    <tr>
                                <td>
                                  <?php if($data['fic']>0) {echo $data['fic'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed1']>0) {echo $data['breastfed1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed2']>0) {echo $data['breastfed2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed3']>0) {echo $data['breastfed3'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed4']>0) {echo $data['breastfed4'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed5']>0) {echo $data['breastfed5'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['breastfed6']>0) {echo $data['breastfed6'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['comple']>0) {echo $data['comple'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['remarks']; ?>
                                </td>
                                    </tr>
                                    <?php
                              } ?>
                              </tbody>
                              </tbody>
                            </table>

                        <?php } ?>


                        <?php
                        if ($service == "nutrition2") {
                          ?>

                        <br>
                        <ul class="nav nav-tabs font-weight-bold">
                          <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#page1">
                              <icon class="fa fa-file"></icon> Page 1
                            </a>
                          </li>
                          <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#page2">
                              <i class="fa fa-file"></i> Page 2</a>
                          </li>
                        </ul>

                        <?php
                        $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                weight, height, sex, mother_name, CONCAT(purok, ', ', address) AS caddress FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active py-3" id="page1">
                            <table id="example" class="table table-bordered table-hover table-sm text-center" cellspacing="0"
                              width="100%">
                              <thead>
                                <tr>
                                  <th>Date of Registration</th>
                                  <th>Date of Birth</th>
                                  <th>Name of Child</th>
                                  <th>Weight</th>
                                  <th>Height</th>
                                  <th>Sex</th>
                                  <th>Name of Mother</th>
                                  <th>Complete Address</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                    <tr>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php echo $data['birthdate']; ?>
                                </td>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php if($data['weight']>0) {echo $data['weight'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['height']>0) {echo $data['height'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['sex']; ?>
                                </td>
                                <td>
                                  <?php echo $data['mother_name']; ?>
                                </td>
                                <td>
                                  <?php echo $data['caddress']; ?>
                                </td>
                                        </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
                          </div>

                          <?php
                          $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
                      DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
                      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
                DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
                DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM $service WHERE reg_date between '$date' AND '$newDate'");
                          ?>

                          <div class="tab-pane fade py-3" id="page2">
                            <table id="example1" class="table table-bordered table-hover table-sm text-center" width="100%">
                              <thead>
                                <tr>
                                  <th colspan="7">Micronutrient Supplementation</th>
                                  <th rowspan="2">Deworming</th>
                                  <th rowspan="4">Remarks</th>
                                </tr>
                                <tr>
                                  <th colspan="3">Vitamin A</th>
                                  <th colspan="2">Iron</th>
                                  <th colspan="2">MNP</th>
                                </tr>
                                <tr>
                                  <th rowspan="2">6-11 mos.</th>
                                  <th colspan="2">12-59 mos.</th>
                                  <th rowspan="2">6-11 mos.</th>
                                  <th rowspan="2">12-59 mos.</th>
                                  <th rowspan="2">6-11 mos.</th>
                                  <th rowspan="2">12-23 mos.</th>
                                  <th rowspan="2">12-59 mos.</th>
                                </tr>
                                <tr>
                                  <th>Dose 1</th>
                                  <th>Dose 2</th>
                                </tr>
                              </thead>
                              <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                    <tr>
                                <td>
                                  <?php if($data['vitamin']>0) {echo $data['vitamin'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['vitamindose1']>0) {echo $data['vitamindose1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['vitamindose2']>0) {echo $data['vitamindose2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['irondose1']>0) {echo $data['irondose1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['irondose2']>0) {echo $data['irondose2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['mnpdose1']>0) {echo $data['mnpdose1'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['mnpdose2']>0) {echo $data['mnpdose2'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['dewormings']>0) {echo $data['dewormings'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['remarks']; ?>
                                </td>
                                    </tr>

                                    <?php
                              } ?>

                              </tbody>
                            </table>

                        <?php } ?>



                        <?php
                        if ($service == "sickchildren") {
                          ?>

                    <br>
                      <ul class="nav nav-tabs font-weight-bold">
                        <li class="nav-item">
                          <a data-toggle="tab" class="nav-link active" href="#page1">
                            <icon class="fa fa-file"></icon> Page 1
                          </a>
                        </li>
                        <li class="nav-item">
                          <a data-toggle="tab" class="nav-link" href="#page2">
                            <i class="fa fa-file"></i> Page 2</a>
                        </li>
                      </ul>

                      <?php
                      $sickchildren = mysqli_query($con, "SELECT sick_children_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status FROM $service WHERE reg_date between '$date' AND '$newDate'");
                      ?>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active py-3" id="page1">
                          <table id="example" class="table table-bordered table-hover table-sm text-center" cellspacing="0"
                            width="100%">
                            <thead>
                              <tr>
                                <th>Date of Registration</th>
                                <th>Name of Child</th>
                                <th>Date of Birth</th>
                                <th>Sex</th>
                                <th>Name of Mother</th>
                                <th>Complete Address</th>
                                <th class="font-weight-normal"><b>SE Status</b> 
                                <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['birthdate']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['sex']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['mother_name']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['caddress']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['se_status']; ?>
                                    </td>
                                  </tr>

                                  <?php
                              } ?>

                            </tbody>
                          </table>
                        </div>

                        <?php
                        $sickchildren = mysqli_query($con, "SELECT sick_children_id, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
                DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
                DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
                pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>

                        <div class="tab-pane fade py-3" id="page2">
                          <table id="example1" class="table table-bordered table-hover table-sm text-center" width="100%">
                            <thead>
                              <tr>
                                <th colspan="4">Vitamin A Supplementation</th>
                                <th colspan="3">Diarrhea Cases Seen and Given Treatment</th>
                                <th colspan="2">Pneumonia Cases Seen and Given Treatment</th>
                                <th rowspan="3">Remarks</th>
                              </tr>
                              <tr>
                                <th colspan="2">Put a (✓)</th>
                                <th rowspan="2">Diagnosis/ <br>Findings</th>
                                <th rowspan="2">Date Given
                                <th rowspan="2">Age in Months</th>
                                <th colspan="2">Date Given</th>
                                <th rowspan="2">Age in Months</th>
                                <th rowspan="2">Date Given Treatment</th>
                              </tr>
                              <tr>
                                <th>6-11 mos.</th>
                                <th>12-59 mos.</th>
                                <th>ORS</th>
                                <th>Oral zinc drops or syrup</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                  <tr>
                                              <td>
                                              <?php echo $data['vitamin_6to11mos']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['vitamin_12to59mos']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['diagnosis']; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['vitamindate'] > 0) {
                                                echo $data['vitamindate'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['diarrhea_age'] > 0) {
                                                echo $data['diarrhea_age'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['orsdate'] > 0) {
                                                echo $data['orsdate'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['oralzincdate'] > 0) {
                                                echo $data['oralzincdate'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['pneumonia_age'] > 0) {
                                                echo $data['pneumonia_age'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['pneumoniadate'] > 0) {
                                                echo $data['pneumoniadate'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['remarks']; ?>
                                            </td>
                                  </tr>

                                  <?php
                              } ?>
                            </tbody>
                          </table>

                        <?php } ?>



                        <?php
                        if ($service == "maternal") {
                          ?>

                    <br>
                      <ul class="nav nav-tabs font-weight-bold">
                        <li class="nav-item">
                          <a data-toggle="tab" class="nav-link active" href="#page1">
                            <i class="fa fa-file"></i> Page 1</a>
                        </li>
                        <li class="nav-item">
                          <a data-toggle="tab" class="nav-link" href="#page2">
                            <i class="fa fa-file"></i> Page 2</a>
                        </li>
                        <li class="nav-item">
                          <a data-toggle="tab" class="nav-link" href="#page3">
                            <i class="fa fa-file"></i> Page 3</a>
                        </li>
                      </ul>

                      <?php
                      $maternal = mysqli_query($con, "SELECT maternal_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                      age, DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
                      DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
                      DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
                      DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a FROM $service 
                      WHERE reg_date between '$date' AND '$newDate'");
                      ?>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active py-3" id="page1">
                          <table id="example" class="table table-bordered table-hover table-sm text-center" cellspacing="0"
                            width="100%">
                            <thead>
                              <tr>
                                <th rowspan="2">Date of <br>Registration</th>
                                <th rowspan="2">Name</th>
                                <th rowspan="2">Address</th>
                                <th rowspan="2">Age</th>
                                <th rowspan="2">LMP <br>G-P</th>
                                <th rowspan="2">EDC</th>
                                <th colspan="3">Prenatal Visits</th>
                              </tr>
                              <tr>
                                <th>First Trimester</th>
                                <th>Second Trimester</th>
                                <th>Third Trimester</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($maternal)) { ?>

                                  <tr>
                              <td>
                                <?php echo $data['regdate']; ?>
                              </td>
                              <td>
                                <?php echo $data['fullname']; ?>
                              </td>
                              <td>
                                <?php echo $data['purok']; ?>, <br><?php echo $data['address']; ?>
                              </td>
                              <td>
                                <?php echo $data['age']; ?>
                              </td>
                              <td>
                              <?php if($data['lmpdate']>0) {echo $data['lmpdate'];}; ?> 
                                <br><?php echo 'G' . $data['g']; ?>
                                <?php echo 'P' . $data['p']; ?>
                              </td>
                              <td>
                                <?php if($data['edcdate']>0) {echo $data['edcdate'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tri1']>0) {echo $data['tri1'];}; ?> <br>
                                <?php if($data['tri1a']>0) {echo $data['tri1a'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tri2']>0) {echo $data['tri2'];}; ?> <br>
                                <?php if($data['tri2a']>0) {echo $data['tri2a'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tri3']>0) {echo $data['tri3'];}; ?> <br>
                                <?php if($data['tri3a']>0) {echo $data['tri3a'];}; ?>
                              </td>
                                  </tr>

                              <?php } ?>

                            </tbody>
                          </table>
                        </div>


                        <?php
                        $maternal = mysqli_query($con, "SELECT maternal_id, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
                  DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
                  DATE_FORMAT(iron1stdate,'%m-%d-%Y') AS iron1st, 1stdatenumber, DATE_FORMAT(iron2nddate,'%m-%d-%Y') AS iron2nd, 2nddatenumber,
                  DATE_FORMAT(iron3rddate,'%m-%d-%Y') AS iron3rd, 3rddatenumber, DATE_FORMAT(iron4thdate,'%m-%d-%Y') AS iron4th, 4thdatenumber,
                  DATE_FORMAT(iron5thdate,'%m-%d-%Y') AS iron5th, 5thdatenumber, DATE_FORMAT(iron6thdate,'%m-%d-%Y') AS iron6th, 6thdatenumber
                  FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>

                        <div class="tab-pane fade py-3" id="page2">
                          <table id="example1" class="table table-bordered table-hover table-sm text-center" width="100%">
                            <thead>
                              <tr>
                                <th rowspan="3">Tetanus <br>Status</th>
                                <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
                                <th colspan="6">Micronutrient Supplementation</th>
                              </tr>
                              <tr>
                                <th rowspan="2">TT1</th>
                                <th rowspan="2">TT2</th>
                                <th rowspan="2">TT3</th>
                                <th rowspan="2">TT4</th>
                                <th rowspan="2">TT5</th>
                                <th colspan="6">Date and Number <br>Iron with Folic Acid was given</th>
                              </tr>
                              <tr>
                                <th><br></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($maternal)) { ?>

                                  <tr>
                              <td>
                                <?php echo $data['tetanus_status']; ?>
                              </td>
                              <td>
                                <?php if($data['tt1']>0) {echo $data['tt1'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt2']>0) {echo $data['tt2'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt3']>0) {echo $data['tt3'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt4']>0) {echo $data['tt4'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt5']>0) {echo $data['tt5'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron1st']>0) {echo $data['iron1st'];}; ?><br>
                                <?php if($data['1stdatenumber']>0) {echo $data['1stdatenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron2nd']>0) {echo $data['iron2nd'];}; ?><br>
                                <?php if($data['2nddatenumber']>0) {echo $data['2nddatenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron3rd']>0) {echo $data['iron3rd'];}; ?><br>
                                <?php if($data['3rddatenumber']>0) {echo $data['3rddatenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron4th']>0) {echo $data['iron4th'];}; ?><br>
                                <?php if($data['4thdatenumber']>0) {echo $data['4thdatenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron5th']>0) {echo $data['iron5th'];}; ?><br>
                                <?php if($data['5thdatenumber']>0) {echo $data['5thdatenumber'];}; ?>
                                </td>
                                <td>
                                <?php if($data['iron6th']>0) {echo $data['iron6th'];}; ?><br>
                                <?php if($data['6thdatenumber']>0) {echo $data['6thdatenumber'];}; ?>
                                </td>
                                      </tr>

                              <?php } ?>

                            </tbody>
                          </table>
                        </div>


                        <?php
                        $maternal = mysqli_query($con, "SELECT maternal_id, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
                  syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
                  DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
                  DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
                  outcome, gender, birth_weight, facility, nid, attended, remarks FROM $service WHERE reg_date between '$date' AND '$newDate'");
                        ?>


                        <div class="tab-pane fade py-3" id="page3">
                          <table id="example2" class="table table-bordered table-hover table-sm text-center" width="100%">
                            <thead>
                              <tr>
                                <th colspan="3">STI Surveillance</th>
                                <th colspan="2">Pregnancy</th>
                                <th colspan="4">Livebirths</th>
                                <th rowspan="3">Remarks</th>
                              </tr>
                              <tr>
                                <th>Tested for SY</th>
                                <th>Result for <br>SY Testing</th>
                                <th>Given Penicillin</th>
                                <th rowspan="2">Date Terminated</th>
                                <th rowspan="2">Outcome / <br>Gender (M/F)</th>
                                <th rowspan="2" class="font-weight-normal"><b>Birth <br>Weight</b> <br>(grams)</th>
                                <th colspan="2">Place of</th>
                                <th rowspan="2">Attended by</th>
                              </tr>
                              <tr>
                                <th>Date</th>
                                <th>(+/-) / <br>Date</th>
                                <th>Y/N <br>Date</th>
                                <th>Health Facility</th>
                                <th>NID</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($maternal)) { ?>

                                  <tr>
                              <td>
                                <?php if($data['sy_date']>0) {echo $data['sy_date'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['syresult']; ?> <br>
                                <?php if($data['result_date']>0) {echo $data['result_date'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['given_penicillin']; ?> <br>
                                <?php if($data['penicillin_date']>0) {echo $data['penicillin_date'];}; ?>
                              </td>
                              <td>
                                <?php if($data['terminated_date']>0) {echo $data['terminated_date'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['outcome']; ?> <br>
                                <?php echo $data['gender']; ?>
                              </td>
                              <td>
                                <?php if($data['birth_weight']>0) {echo $data['birth_weight'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['facility']; ?>
                              </td>
                              <td>
                                <?php echo $data['nid']; ?>
                              </td>
                              <td>
                                <?php echo $data['attended']; ?>
                              </td>
                              <td>
                                <?php echo $data['remarks']; ?>
                              </td>
                                  </tr>

                              <?php } ?>

                            </tbody>
                          </table>

                        <?php } ?>


                        <?php
                        if ($service == "postpartum") {
                          ?>

                    <table id="example" class="table table-bordered table-hover table-sm text-center">
                      <thead>
                        <tr>
                          <th rowspan="3">Date <br>and Time <br>of Delivery</th>
                          <th rowspan="3">Name</th>
                          <th rowspan="3">Address</th>
                          <th colspan="2">Date Postpartum Visits</th>
                          <th rowspan="3">Date <br>and Time <br>Initiated <br>Brestfeeding</th>
                          <th colspan="4">Micronutrient Supplementation</th>
                          <th rowspan="3">Remarks</th>
                        </tr>
                        <tr>
                          <th rowspan="2">Within <br>24 hours <br>after <br>delivery</th>
                          <th rowspan="2">Within <br>1 week <br>after <br>delivery</th>
                          <th colspan="3">Iron</th>
                          <th>Vitamin A</th>
                        </tr>
                        <tr>
                          <th colspan="3">Date / No. Tablets</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        $postpartum = mysqli_query($con, "SELECT postpartum_id, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, 
                    TIME_FORMAT(delivery_time, '%h:%i %p') AS deliverytime, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, TIME_FORMAT(time_breastfeed, '%h:%i %p') AS timebreastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks 
                    FROM $service WHERE delivery_date between '$date' AND '$newDate'");
                        while ($data = mysqli_fetch_array($postpartum)) { ?>

                            <tr>
                                      <td>
                                      <?php echo $data['deliverydate']; ?> <br>
                                      <?php echo $data['deliverytime']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['purok']; ?>, <br><?php echo $data['address']; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['visit24hr'] > 0) {
                                        echo $data['visit24hr'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['visit1week'] > 0) {
                                        echo $data['visit1week'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['datebreastfeed'] > 0) {
                                        echo $data['datebreastfeed'];
                                      }
                                      ; ?> <br>
                                      <?php if ($data['timebreastfeed'] > 0) {
                                        echo $data['timebreastfeed'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['iron1stdate'] > 0) {
                                        echo $data['iron1stdate'];
                                      }
                                      ; ?> <br>
                                      <?php if ($data['1stdate_tablets'] > 0) {
                                        echo $data['1stdate_tablets'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['iron2nddate'] > 0) {
                                        echo $data['iron2nddate'];
                                      }
                                      ; ?> <br>
                                      <?php if ($data['2nddate_tablets'] > 0) {
                                        echo $data['2nddate_tablets'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['iron3rddate'] > 0) {
                                        echo $data['iron3rddate'];
                                      }
                                      ; ?> <br>
                                      <?php if ($data['3rddate_tablets'] > 0) {
                                        echo $data['3rddate_tablets'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php if ($data['vitamindate'] > 0) {
                                        echo $data['vitamindate'];
                                      }
                                      ; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['remarks']; ?>
                                    </td>
                            </tr>

                        <?php } ?>

                      </tbody>

                    </table>

                        <?php } ?>

                </form>

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

      <?php } elseif ($_SESSION['type'] == "Nurse") {
  header("Location: ../../index.php"); } ?>

  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
      $('#example').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $(function () {
      $('#example3').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<?php } ?>

</body>

</html>