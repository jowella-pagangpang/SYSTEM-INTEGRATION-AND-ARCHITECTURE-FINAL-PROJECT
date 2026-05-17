<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $search1 = $_POST['search1'];
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

    <title>Search Result</title>
    <link rel="icon" href="../../img/logo.png">

    <style>
      h6 {
        padding-left: 18px;
        margin-bottom: -15px !important;
      }
      #example_wrapper {
          box-shadow: none;
        }
        #example_paginate {
          display: none;
        }
        .dataTables_filter, .dataTables_info {
          display: none;
        }
        #example tbody tr:hover {
          background-color: #f2f2f2;
        }
        .card-header {
          border: none;
        }
        table.dataTable.no-footer {
          border-bottom: 0 !important;
        }
        #example {
          border-collapse: collapse;
        }
        #example thead th,
        #example td {
          text-align: left !important;
          border: none;
          vertical-align: middle;
        }
    </style>
  </head>


<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
       <?php
    include('../sidebar.php');
    ?>

    <?php
    if ($_SESSION['type'] == "Barangay Health Worker") {
      ?>

<?php

$immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2, length, weight, birth_weight_status, 
                  DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
                  DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
                  DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
                  DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
                  DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
                  DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
                  DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
                  remarks FROM immunization WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

$i = mysqli_num_rows($immunization);

$deworming1st = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                    FROM deworming WHERE service = 'Deworming 1-4 years old' AND (fname LIKE '$search1' OR lname LIKE '$search1')");

  $d1 = mysqli_num_rows($deworming1st);

  $deworming2nd = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                  purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                  DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                  FROM deworming WHERE service = 'Deworming 5-9 years old' AND (fname LIKE '$search1' OR lname LIKE '$search1')");

  $d2 = mysqli_num_rows($deworming2nd);

  $deworming3rd = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                  purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                  DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                  FROM deworming WHERE service = 'Deworming 10-19 years old' AND (fname LIKE '$search1' OR lname LIKE '$search1')");

  $d3 = mysqli_num_rows($deworming3rd);

  $postpartum = mysqli_query($con, "SELECT postpartum_id, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

  $p = mysqli_num_rows($postpartum);

  $sickchildren = mysqli_query($con, "SELECT sick_children_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
                DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
                DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
                pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks FROM sickchildren WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

  $sc = mysqli_num_rows($sickchildren);

  $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, weight, height, sex, mother_name, 
                    purok, address, DATE_FORMAT(screening_done,'%m-%d-%Y') AS done, tetanus_status, 
                    DATE_FORMAT(date_ttstatus,'%m-%d-%Y') AS datett, DATE_FORMAT(date_assess,'%m-%d-%Y') AS assess, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate, 
                    DATE_FORMAT(hepab1,'%m-%d-%Y') AS hepadate, DATE_FORMAT(pentavalent1st,'%m-%d-%Y') AS penta1, 
                    DATE_FORMAT(pentavalent2nd,'%m-%d-%Y') AS penta2, DATE_FORMAT(pentavalent3rd, '%m-%d-%Y') AS penta3, 
                    DATE_FORMAT(opv1st,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv2nd,'%m-%d-%Y') AS opv2, DATE_FORMAT(opv3rd,'%m-%d-%Y') AS opv3, 
                    DATE_FORMAT(ipv,'%m-%d-%Y') AS ipv1, DATE_FORMAT(mcv1,'%m-%d-%Y') AS mcv1st, DATE_FORMAT(mcv2,'%m-%d-%Y') AS mcv2nd, nutrition1_id, DATE_FORMAT(ficdate,'%m-%d-%Y') AS fic, 
                    DATE_FORMAT(breastfed1st,'%m-%d-%Y') AS breastfed1, DATE_FORMAT(breastfed2nd,'%m-%d-%Y') AS breastfed2, 
                    DATE_FORMAT(breastfed3rd,'%m-%d-%Y') AS breastfed3, DATE_FORMAT(breastfed4th, '%m-%d-%Y') AS breastfed4,  
                   DATE_FORMAT(breastfed5th,'%m-%d-%Y') AS breastfed5, DATE_FORMAT(breastfed6th,'%m-%d-%Y') AS breastfed6, 
                    DATE_FORMAT(complementary,'%m-%d-%Y') AS comple, remarks FROM nutrition1 WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

  $n1 = mysqli_num_rows($nutrition1);

  $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
                      DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
                      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
                DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
                DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

  $n2 = mysqli_num_rows($nutrition2);

  $maternal = mysqli_query($con, "SELECT maternal_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                  age, DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
                  DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
                  DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
                  DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
                  DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
                  DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
                  DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
                  DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
                  syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
                  DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
                  DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
                  outcome, gender, birth_weight, facility, nid, attended, remarks FROM maternal WHERE fname LIKE '$search1' OR lname LIKE '$search1'");

  $m = mysqli_num_rows($maternal);
?>

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <h1 class="brand-link text-center">
          <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">Health Record
            Management</span>
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
                                            <a href="../immunization/immunization.php" class="nav-link  <?php echo (isset($i) && $i > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Immunization (0-12 mos. old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming1/deworming1-4.php" class="nav-link  <?php echo (isset($d1) && $d1 > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (1-4 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming2/deworming5-9.php" class="nav-link <?php echo (isset($d2) && $d2 > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (5-9 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming3/deworming10-19.php" class="nav-link <?php echo (isset($d3) && $d3 > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (10-19 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition1/nutrition1.php" class="nav-link <?php echo (isset($n1) && $n1 > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program I</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition2/nutrition2.php" class="nav-link <?php echo (isset($n2) && $n2 > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program II</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../sickchildren/sickchildren.php" class="nav-link  <?php echo (isset($sc) && $sc > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Sick Children</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../maternal/maternal.php" class="nav-link  <?php echo (isset($m) && $m > 0) ? 'active' : ''; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Maternal Care</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../postpartum/postpartum.php" class="nav-link  <?php echo (isset($p) && $p > 0) ? 'active' : ''; ?>">
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

                                  <div class="col-9">
                                    <h4 class="font-weight-bold" style="font-family: Helvetica;">Search result for '<?php echo $search1 ?>': </h4>
                              </div>
                              <div class="col-2">
                              </div>
                              <div class="col-1">
                                <div class="form-group">
                                  <a href="dashboard.php" class="btn btn-dark bg-gradient-dark btn-block">Back</a>
                                </div>
                              </div>

                            </div><!-- /.row -->
                          </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

<?php

    if ($d1 > 0) {
      ?>
      <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR DEWORMING SERVICES
                      FOR 1-4 YEARS OLD</h6>
      
                    <form method="post">
                      <div class="card-body d-flex flex-column">
                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
                              <th>Complete Address</th>
                              <th>Age</th>
                            </tr>
                          </thead>
                          <tbody>

  <?php
        while ($data = mysqli_fetch_array($deworming1st)) { ?>
        <tr>
          <td>
            <?php echo $data['fullname']; ?>
          </td>
          <td>
            <?php echo $data['regdate']; ?>
          </td>
          <td>
            <?php echo $data['sex']; ?>
          </td>
          <td>
            <?php echo $data['purok']; ?>,
            <?php echo $data['address']; ?>
          </td>
          <td>
            <?php echo $data['age']; ?>
          </td>
          <td>
            <a href="../deworming1/editclient.php?did1=<?php echo $data['deworming_id']; ?>">
              <button type="button" class="btn btn-primary btn-xs">
                <i class="nav-icon fas fa-edit"></i> Edit</button>
            </a>
          </td>
        </tr>

  <?php
        } ?>
      </tbody>

      </table>
      </div>
      <!-- /.card-body -->
      </form>

      </div>
      <!-- /.card -->

      </div>
      </div>
      </section>
    
    <?php
    } ?>
          

    <?php

    if ($d2 > 0) {
      ?>
      <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR DEWORMING SERVICES
                      FOR 5-9 YEARS OLD</h6>
      
                    <form method="post">
                      <div class="card-body d-flex flex-column">
                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                          <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
                              <th>Complete Address</th>
                              <th>Age</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

  <?php
        while ($data = mysqli_fetch_array($deworming2nd)) { ?>
        <tr>
          <td>
            <?php echo $data['fullname']; ?>
          </td>
          <td>
            <?php echo $data['regdate']; ?>
          </td>
          <td>
            <?php echo $data['sex']; ?>
          </td>
          <td>
            <?php echo $data['purok']; ?>,
            <?php echo $data['address']; ?>
          </td>
          <td>
            <?php echo $data['age']; ?>
          </td>
              <td>
                <a href="../deworming2/editclient.php?did2=<?php echo $data['deworming_id']; ?>">
                  <button type="button" class="btn btn-primary btn-xs">
                    <i class="nav-icon fas fa-edit"></i> Edit</button>
                </a>
              </td>
            </tr>
    
          <?php } ?>
          </tbody>
    
          </table>
          </div>
          <!-- /.card-body -->
          </form>
    
          </div>
          <!-- /.card -->
          </div>
          </div>
          </section>
        
<?php
    } ?>

<?php
    if ($d3 > 0) {
      ?><section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR DEWORMING SERVICES
                      FOR 10-19 YEARS OLD</h6>
      
                    <form method="post">
                      <div class="card-body d-flex flex-column">
      
                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                          <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
                              <th>Complete Address</th>
                              <th>Age</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

  <?php
        while ($data = mysqli_fetch_array($deworming3rd)) { ?>
        <tr>
          <td>
            <?php echo $data['fullname']; ?>
          </td>
          <td>
            <?php echo $data['regdate']; ?>
          </td>
          <td>
            <?php echo $data['sex']; ?>
          </td>
          <td>
            <?php echo $data['purok']; ?>,
            <?php echo $data['address']; ?>
          </td>
          <td>
            <?php echo $data['age']; ?>
          </td>
          <td>
            <a href="../deworming3/editclient.php?did3=<?php echo $data['deworming_id']; ?>">
              <button type="button" class="btn btn-primary btn-xs">
                <i class="nav-icon fas fa-edit"></i> Edit</button>
            </a>
          </td>
          </tr>
        <?php } ?>
        </tbody>
  
        </table>
        </div>
        <!-- /.card-body -->
        </form>
  
        </div>
        <!-- /.card -->
  
        </div>
        </div>
        </section>
        
<?php
    } ?>

<?php
    if ($p > 0) {
      ?><section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
      
                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR POSTPARTUM CARE</h6>
      
                    <form method="post">
                      <div class="card-body d-flex flex-column">
      
                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th rowspan="3">Date <br>and Time <br>of Delivery</th>
                              <th rowspan="3">Name</th>
                              <th rowspan="3">Address</th>
                              <th colspan="2">Date Postpartum Visits</th>
                              <th rowspan="3">Date <br>and Time <br>Initiated <br>Brestfeeding</th>
                              <th colspan="4">Micronutrient Supplementation</th>
                              <th rowspan="3">Remarks</th>
                              <th rowspan="3">Action</th>
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
      while ($data = mysqli_fetch_array($postpartum)) { ?>

                <tr>
                  <td>
                    <?php echo $data['deliverydate']; ?> <br>
            <?php echo $data['delivery_time']; ?>
          </td>
          <td>
            <?php echo $data['fullname']; ?>
          </td>
          <td>
            <?php echo $data['purok']; ?>, <br>
            <?php echo $data['address']; ?>
          </td>
          <td>
            <?php if ($data['visit24hr'] != '00-00-0000') {
              echo $data['visit24hr'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['visit1week'] != '00-00-0000') {
              echo $data['visit1week'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['datebreastfeed'] != '00-00-0000') {
              echo $data['datebreastfeed'];
            }
            ; ?> <br>
            <?php if ($data['time_breastfeed'] > 0) {
              echo $data['time_breastfeed'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['iron1stdate'] != '00-00-0000') {
              echo $data['iron1stdate'];
            }
            ; ?> <br>
            <?php if ($data['1stdate_tablets'] > 0) {
              echo $data['1stdate_tablets'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['iron2nddate'] != '00-00-0000') {
              echo $data['iron2nddate'];
            }
            ; ?> <br>
            <?php if ($data['2nddate_tablets'] > 0) {
              echo $data['2nddate_tablets'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['iron3rddate'] != '00-00-0000') {
              echo $data['iron3rddate'];
            }
            ; ?> <br>
            <?php if ($data['3rddate_tablets'] > 0) {
              echo $data['3rddate_tablets'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['vitamindate'] != '00-00-0000') {
              echo $data['vitamindate'];
            }
            ; ?>
          </td>
          <td>
            <?php echo nl2br($data['remarks']); ?>
          </td>
          <td>
            <a href="../postpartum/editclient.php?pid=<?php echo $data['postpartum_id']; ?>">
              <button type="button" class="btn btn-primary btn-sm">
                <i class="nav-icon fas fa-edit"></i></button>
            </a>
          </td>
        </tr>
        <?php
      } ?>
      </tbody>

      </table>
      </div>
      <!-- /.card-body -->
      </form>

      </div>
      <!-- /.card -->
      </div>
      </div>
      </section>

      <?php
    } ?>

<?php
    if ($sc > 0) {
      ?>
      <section class="content text-sm" style="font-family: Helvetica;">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <br>
              <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR SICK CHILDREN</h6>

              <form method="post">
                <div class="card-body d-flex flex-column">

                  <br>
                  <table id="example" class="table table-hover"">
                    <thead>
                      <tr>
                        <th rowspan="3">Date of Registration</th>
                        <th rowspan="3">Name of Child</th>
                        <th rowspan="3">Date of Birth</th>
                        <th rowspan="3">Sex</th>
                        <th rowspan="3">Name of Mother</th>
                        <th rowspan="3">Complete Address</th>
                        <th rowspan="3" class="font-weight-normal"><b>SE Status</b>
                          <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                        </th>
                        <th colspan="4">Vitamin A Supplementation</th>
                        <th colspan="3">Diarrhea Cases Seen and Given Treatment</th>
                        <th colspan="2">Pneumonia Cases Seen and Given Treatment</th>
                        <th rowspan="3">Remarks</th>
                        <th rowspan="3">Action</th>
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
            <?php if ($data['vitamindate'] != '00-00-0000') {
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
            <?php if ($data['orsdate'] != '00-00-0000') {
              echo $data['orsdate'];
            }
            ; ?>
          </td>
          <td>
            <?php if ($data['oralzincdate'] != '00-00-0000') {
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
            <?php if ($data['pneumoniadate'] != '00-00-0000') {
              echo $data['pneumoniadate'];
            }
            ; ?>
          </td>
          <td>
            <?php echo nl2br($data['remarks']); ?>
          </td>
          <td>
            <a href="../sickchildren/editclient.php?sid=<?php echo $data['sick_children_id']; ?>">
              <button type="button" class="btn btn-primary btn-sm">
                <i class="nav-icon fas fa-edit"></i></button>
            </a>
          </td>
        </tr>

  <?php } ?>

</tbody>
  
        </table>
        </div>
        <!-- /.card-body -->
        </form>
  
        </div>
        <!-- /.card -->
  
        </div>
        </div>
        </section>
  
        <?php
    } ?>

<?php
    if ($n1 > 0) {
      ?>
      <section class="content text-sm" style="font-family: Helvetica;">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <br>
              <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR NUTRITION AND
                EXPANDED PROGRAM FOR IMMUNIZATION PART I</h6>

              <form method="post">
                <div class="card-body d-flex flex-column">
                  <br>
                  <table id="example" class="table table-hover">
                    <thead>
                      <tr>
                        <th rowspan="3">Date of <br>Registration</th>
                        <th rowspan="3">Date of Birth</th>
                        <th rowspan="3">Name of Child</th>
                        <th rowspan="3">Weight</th>
                        <th rowspan="3">Height</th>
                        <th rowspan="3">Sex</th>
                        <th rowspan="3">Name of Mother</th>
                        <th rowspan="3">Complete Address</th>
                        <th>Date Newborn <br>Screening</th>
                        <th colspan="2">Child Protected at Birth (CPAB)</th>
                        <th colspan="11">Date Immunization Received</th>
                        <th rowspan="3">Date Fully <br>Immunized Child <br>(FIC)</th>
                        <th colspan="6">Child was Exclusively Breastfed</th>
                        <th>Complementary Feeding</th>
                        <th rowspan="3">Remarks</th>
                        <th rowspan="3">Action</th>
                      </tr>
                      <tr>
                        <th rowspan="2">Done</th>
                        <th rowspan="2">TT Status <br>/ Date</th>
                        <th rowspan="2">Date Assess</th>
                        <th rowspan="2">BCG</th>
                        <th>HEPA B1</th>
                        <th colspan="3">Pentavalent</th>
                        <th colspan="3">OPV</th>
                        <th rowspan="2">IPV</th>
                        <th colspan="2">MCV</th>
                        <th rowspan="2">1st MO</th>
                        <th rowspan="2">2nd MO</th>
                        <th rowspan="2">3rd MO</th>
                        <th rowspan="2">4th MO</th>
                        <th rowspan="2">5th MO</th>
                        <th rowspan="2">6th MO</th>
                        <th rowspan="2">6th MO</th>
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
                                                                                  <?php echo $data['regdate']; ?>
                                                                                </td>
                                                                                <td>
                                                                                  <?php echo $data['birthdate']; ?>
                                                                                </td>
                                                                                <td>
                                                                          <?php echo $data['fullname']; ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php if ($data['weight'] > 0) {
                                                                          echo $data['weight'];
                                                                        }
                                                                        ; ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php if ($data['height'] > 0) {
                                                                          echo $data['height'];
                                                                        }
                                                                        ; ?>
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
                                                                          <?php if ($data['done'] != '00-00-0000') {
                                                                            echo $data['done'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php echo $data['tetanus_status']; ?><br>
                                                                        <?php if ($data['datett'] != '00-00-0000') {
                                                                          echo $data['datett'];
                                                                        }
                                                                        ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['assess'] != '00-00-0000') {
                                                                            echo $data['assess'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['bcgdate'] != '00-00-0000') {
                                                                            echo $data['bcgdate'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['hepadate'] != '00-00-0000') {
                                                                            echo $data['hepadate'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['penta1'] != '00-00-0000') {
                                                                            echo $data['penta1'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['penta2'] != '00-00-0000') {
                                                                            echo $data['penta2'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['penta3'] != '00-00-0000') {
                                                                            echo $data['penta3'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['opv1'] != '00-00-0000') {
                                                                            echo $data['opv1'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['opv2'] != '00-00-0000') {
                                                                            echo $data['opv2'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['opv3'] != '00-00-0000') {
                                                                            echo $data['opv3'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['ipv1'] != '00-00-0000') {
                                                                            echo $data['ipv1'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['mcv1st'] != '00-00-0000') {
                                                                            echo $data['mcv1st'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php if ($data['mcv2nd'] != '00-00-0000') {
                                                                            echo $data['mcv2nd'];
                                                                          }
                                                                          ; ?>
                                                                        </td>
                                                              <td>
                                                                <?php if ($data['fic'] != '00-00-0000') {
                                                                  echo $data['fic'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed1'] != '00-00-0000') {
                                                                  echo $data['breastfed1'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed2'] != '00-00-0000') {
                                                                  echo $data['breastfed2'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed3'] != '00-00-0000') {
                                                                  echo $data['breastfed3'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed4'] != '00-00-0000') {
                                                                  echo $data['breastfed4'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed5'] != '00-00-0000') {
                                                                  echo $data['breastfed5'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfed6'] != '00-00-0000') {
                                                                  echo $data['breastfed6'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['comple'] != '00-00-0000') {
                                                                  echo $data['comple'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php echo nl2br($data['remarks']); ?>
                                                              </td>
                                                                        <td>
                                                                          <a href="../nutrition1/editclient.php?nid1=<?php echo $data['nutrition1_id']; ?>">
                                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                              <i class="nav-icon fas fa-edit"></i></button>
                                                                          </a>
                                                                        </td>
                                                                      </tr>
                                                                      <?php
                                                        } ?>
                                                </tbody>

                            </table>
                            </div>
                            <!-- /.card-body -->
                            </form>

                            </div>
                            <!-- /.card -->

                            </div>
                                    </div>
                                    </section>
                                   <?php
                                      } ?>



                                      <?php
                                      if ($n2 > 0) {
                                        ?>

                                    <section class="content text-sm" style="font-family: Helvetica;">
                                    <div class="row">
                                      <div class="col-12">
                                    <div class="card">
                                          <br>
                                          <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR NUTRITION AND
                                            EXPANDED PROGRAM FOR IMMUNIZATION PART II</h6>

                                          <form method="post">
                                            <div class="card-body d-flex flex-column">


                                                  <br>
                                                    <table id="example" class="table table-hover">
                                                      <thead>
                                                        <tr>
                                                          <th>Name</th>
                                                          <th>Date of Registration</th>
                                                          <th>Sex</th>
                                                          <th>Name of Mother</th>
                                                          <th>Complete Address</th>
                                                          <th></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>

                                                        <?php
                                                        while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                                                      <tr>
                                                                        <td>
                                                                          <?php echo $data['fullname']; ?>
                                                                        </td>
                                                                        <td>
                                                                          <?php echo $data['regdate']; ?>
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
                                                                          <a href="../nutrition2/editclient.php?nid2=<?php echo $data['nutrition2_id']; ?>">
                                                                            <button type="button" class="btn btn-primary btn-xs">
                                                                              <i class="nav-icon fas fa-edit"></i> Edit</button>
                                                                          </a>
                                                                        </td>
                                                                          </tr>

                                                                      <?php
                                                        } ?>
                                                </tbody>

                            </table>
                            </div>
                            <!-- /.card-body -->
                            </form>

                            </div>
                            <!-- /.card -->
                            </div>
                                    </div>
                                    </section>
                          <?php } ?>



                                    <?php
                                    if ($m > 0) {
                                      ?>

                                    <section class="content text-sm" style="font-family: Helvetica;">
                                    <div class="row">
                                      <div class="col-12">
                          <div class="card">
                                        <br>
                                        <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR MATERNAL CARE
                                        </h6>

                                        <form method="post">
                                          <div class="card-body d-flex flex-column">
                            <br>
                                                  <table id="example" class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th rowspan="3">Date of <br>Registration</th>
                                                        <th rowspan="3">Name</th>
                                                        <th rowspan="3">Address</th>
                                                        <th rowspan="3">Age</th>
                                                        <th rowspan="3">LMP <br>G-P</th>
                                                        <th rowspan="3">EDC</th>
                                                        <th colspan="3">Prenatal Visits</th>
                                                        <th rowspan="3">Tetanus <br>Status</th>
                                                        <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
                                                        <th colspan="6">Micronutrient Supplementation</th>
                                                        <th colspan="3">STI Surveillance</th>
                                                        <th colspan="2">Pregnancy</th>
                                                        <th colspan="4">Livebirths</th>
                                                        <th rowspan="3">Remarks</th>
                                                        <th rowspan="3">Action</th>
                                                      </tr>
                                                      <tr>
                                                        <th rowspan="2">First Trimester</th>
                                                        <th rowspan="2">Second Trimester</th>
                                                        <th rowspan="2">Third Trimester</th>
                                                        <th rowspan="2">TT1</th>
                                                        <th rowspan="2">TT2</th>
                                                        <th rowspan="2">TT3</th>
                                                        <th rowspan="2">TT4</th>
                                                        <th rowspan="2">TT5</th>
                                                        <th colspan="6">Date and Number <br>Iron with Folic Acid was given</th>
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
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
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
                                              <?php if ($data['lmpdate'] != '00-00-0000') {
                                                echo $data['lmpdate'];
                                              }
                                              ; ?> 
                                                <br><?php echo 'G' . $data['g']; ?>
                                                <?php echo 'P' . $data['p']; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['edcdate'] != '00-00-0000') {
                                                                echo $data['edcdate'];
                                                              }
                                                              ; ?>
                                                            </td>
                                      <td>
                                        <?php if ($data['tri1'] != '00-00-0000') {
                                          echo $data['tri1'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri1a'] != '00-00-0000') {
                                          echo $data['tri1a'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tri2'] != '00-00-0000') {
                                          echo $data['tri2'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri2a'] != '00-00-0000') {
                                          echo $data['tri2a'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tri3'] != '00-00-0000') {
                                          echo $data['tri3'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri3a'] != '00-00-0000') {
                                          echo $data['tri3a'];
                                        }
                                        ; ?>
                                      </td>
                                                            <td>
                                                              <?php echo $data['tetanus_status']; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['tt1'] != '00-00-0000') {
                                                                echo $data['tt1'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['tt2'] != '00-00-0000') {
                                                                echo $data['tt2'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['tt3'] != '00-00-0000') {
                                                                echo $data['tt3'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['tt4'] != '00-00-0000') {
                                                                echo $data['tt4'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['tt5'] != '00-00-0000') {
                                                                echo $data['tt5'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['iron1st'] != '00-00-0000') {
                                                                echo $data['iron1st'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['1datenumber'] > 0) {
                                                                echo $data['1datenumber'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['iron2nd'] != '00-00-0000') {
                                                                echo $data['iron2nd'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['2datenumber'] > 0) {
                                                                echo $data['2datenumber'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['iron3rd'] != '00-00-0000') {
                                                                echo $data['iron3rd'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['3datenumber'] > 0) {
                                                                echo $data['3datenumber'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['iron4th'] != '00-00-0000') {
                                                                echo $data['iron4th'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['4datenumber'] > 0) {
                                                                echo $data['4datenumber'];
                                                              }
                                                              ; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['iron5th'] != '00-00-0000') {
                                                                echo $data['iron5th'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['5datenumber'] > 0) {
                                                                echo $data['5datenumber'];
                                                              }
                                                              ; ?>
                                                              </td>
                                                              <td>
                                                              <?php if ($data['iron6th'] != '00-00-0000') {
                                                                echo $data['iron6th'];
                                                              }
                                                              ; ?><br>
                                                              <?php if ($data['6datenumber'] > 0) {
                                                                echo $data['6datenumber'];
                                                              }
                                                              ; ?>
                                                              </td>
                                                            <td>
                                                              <?php if ($data['sy_date'] != '00-00-0000') {
                                                                echo $data['sy_date'];
                                                              }
                                                              ; ?>
                                                            </td>
                                              <td>
                                                <?php echo $data['syresult']; ?> <br>
                                                <?php if ($data['result_date'] != '00-00-0000') {
                                                  echo $data['result_date'];
                                                }
                                                ; ?>
                                              </td>
                                              <td>
                                                <?php echo $data['given_penicillin']; ?> <br>
                                                <?php if ($data['penicillin_date'] != '00-00-0000') {
                                                  echo $data['penicillin_date'];
                                                }
                                                ; ?>
                                              </td>
                                              <td>
                                                <?php if ($data['terminated_date'] != '00-00-0000') {
                                                  echo $data['terminated_date'];
                                                }
                                                ; ?>
                                              </td>
                                                            <td>
                                                              <?php echo $data['outcome']; ?> <br>
                                                              <?php echo $data['gender']; ?>
                                                            </td>
                                                            <td>
                                                              <?php if ($data['birth_weight'] > 0) {
                                                                echo $data['birth_weight'];
                                                              }
                                                              ; ?>
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
                                                              <?php echo nl2br($data['remarks']); ?>
                                                            </td>
                                                                      <td>
                                                                    <a href="../maternal/editclient.php?mid=<?php echo $data['maternal_id']; ?>">
                                                                    <button type="button" class="btn btn-primary btn-sm">
                                                                      <i class="nav-icon fas fa-edit"></i></button>
                                                                    </a>
                                                                        </td>
                                                                    </tr>


                                                                    <?php
                                                      } ?>
                                                            </tbody>
                                
                                                            </table>
                                                            </div>
                                                            <!-- /.card-body -->
                                                            </form>
                                
                                                            </div>
                                                            <!-- /.card -->
                 
                            </div>
                                    </div>
                                    </section>
                          <?php } ?>



                                      <?php

                                      if ($i > 0) {
                                        ?>

                                    <section class="content text-sm" style="font-family: Helvetica;">
                                    <div class="row">
                                      <div class="col-12">
                          <div class="card">
                                            <br>
                                            <h6 class="font-weight-bold text-left">TARGET CLIENT LIST FOR IMMUNIZATION AND
                                              NUTRITION SERVICES FOR 0-12 MONTHS OLD
                                            </h6>

                                            <form method="post">
                                              <div class="card-body d-flex flex-column">
                                               <br>
                                                    <table id="example" class="table table-hover">
                                                      <thead>
                                                        <tr>
                                                          <th rowspan="4">Date of Registration</th>
                                                          <th rowspan="4">Date of Birth</th>
                                                          <th rowspan="4" class="font-weight-normal"><b>SE Status</b>
                                                            <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                                                          </th>
                                                          <th rowspan="4">Name of Child</th>
                                                          <th rowspan="4">Sex</th>
                                                          <th rowspan="4">Name of Mother</th>
                                                          <th rowspan="4">Complete <br>Address</th>
                                                          <th colspan="2">Child Protected at Birth (CPAB)</th>
                                                          <th colspan="6">NEWBORN (0-28 DAYS OLD)</th>
                                                          <th colspan="10">1-3 MONTHS OLD</th>
                                                          <th>6-11 MONTHS OLD</th>
                                                          <th colspan="2">12 MONTHS OLD</th>
                                                          <th rowspan="4">Remarks</th>
                                                          <th rowspan="4">Action</th>
                                                        </tr>
                                                        <tr>
                                                          <th rowspan="3" class="font-weight-normal">TT2/Td2 given <br>to the mother <br>a month prior <br>to
                                                            delivery <br>(for mothers <br>pregnant for the <br>first time)</th>
                                                          <th rowspan="3" class="font-weight-normal">TT3/Td3 <br>to TT5/Td5 <br>(or TT1/Td1 <br>to TT5/Td5)
                                                            <br>given
                                                            to the <br>mother <br>anytime <br>prior to <br>delivery
                                                          </th>
                                                          <th rowspan="3" class="font-weight-normal"><b>Length <br>at Birth</b> <br>(cm)</th>
                                                          <th rowspan="3" class="font-weight-normal"><b>Weight <br>at Birth</b> <br>(kg)</th>
                                                          <th>Status <br>(Birth Weight)</th>
                                                          <th rowspan="3">Initiated breast feeding <br>immediately after birth <br>lasting for 90
                                                            minutes</th>
                                                          <th colspan="2">Immunization</th>
                                                          <th colspan="10">Immunization</th>
                                                          <th rowspan="3">MMR Dose 1 <br>at 9th month</th>
                                                          <th rowspan="3">MMR Dose 2 <br>at 12th month</th>
                                                          <th rowspan="3">FIC</th>
                                                        </tr>
                                                          <tr>
                                                          <th rowspan="2" class="font-weight-normal"><b>L:</b> low: <br>
                                                            <2,500 gms <br><b>N:</b> normal: <br>>2,500 gms <br><b>U:</b> unknown
                                                          </th>
                                                          <th rowspan="2">BCG</th>
                                                          <th rowspan="2">Hepa B-BD</th>
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
                                                              <td>
                                                                <?php if ($data['length'] > 0) {
                                                                  echo $data['length'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['weight'] > 0) {
                                                                  echo $data['weight'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php echo $data['birth_weight_status']; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['breastfeed'] != '00-00-0000') {
                                                                  echo $data['breastfeed'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['bcgdate'] != '00-00-0000') {
                                                                  echo $data['bcgdate'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['hepabdate'] != '00-00-0000') {
                                                                  echo $data['hepabdate'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['dpt_hib_hepb1'] != '00-00-0000') {
                                                                  echo $data['dpt_hib_hepb1'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['dpt_hib_hepb2'] != '00-00-0000') {
                                                                  echo $data['dpt_hib_hepb2'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['dpt_hib_hepb3'] != '00-00-0000') {
                                                                  echo $data['dpt_hib_hepb3'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['opv1'] != '00-00-0000') {
                                                                  echo $data['opv1'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['opv2'] != '00-00-0000') {
                                                                  echo $data['opv2'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['opv3'] != '00-00-0000') {
                                                                  echo $data['opv3'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['pcv1'] != '00-00-0000') {
                                                                  echo $data['pcv1'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['pcv2'] != '00-00-0000') {
                                                                  echo $data['pcv2'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['pcv3'] != '00-00-0000') {
                                                                  echo $data['pcv3'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['ipvdate'] != '00-00-0000') {
                                                                  echo $data['ipvdate'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['mmr1'] != '00-00-0000') {
                                                                  echo $data['mmr1'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['mmr2'] != '00-00-0000') {
                                                                  echo $data['mmr2'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php if ($data['fic'] != '00-00-0000') {
                                                                  echo $data['fic'];
                                                                }
                                                                ; ?>
                                                              </td>
                                                              <td>
                                                                <?php echo nl2br($data['remarks']); ?>
                                                              </td>
                                                                        <td>
                                                                          <a href="../immunization/editclient.php?iid=<?php echo $data['immunization_id']; ?>">
                                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                              <i class="nav-icon fas fa-edit"></i></button>
                                                                          </a>
                                                                        </td>
                                                                      </tr>

                                                        <?php } ?>
                              
                                                          </tbody>
                              
                                                          </table>
                                                          </div>
                                                          <!-- /.card-body -->
                                                          </form>
                              
                                                          </div>
                                                          <!-- /.card -->


                                      </div>
                                  </div>
                                  </section>
                          <?php } ?>

    <?php
    if ($d1 < 1 && $d2 < 1 && $d3 < 1 && $p < 1 && $sc < 1 && $n1 < 1 && $n2 < 1 && $m < 1 && $i < 1) {
        ?>
        <form method="post">
            <section class="content text-sm" style="font-family: Helvetica;">
                <div class="row">
                    <div class="col-12">
                        <br>
                        <h6 class="font-weight-bold text-left">No results found.</h6>
                    </div>
                </div>
            </section>
        </form>

        <?php } ?>
                        </div>
                        </div>
        <!-- ./wrapper -->

                  <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
          } ?>
            
            <!-- DataTables -->


            <!-- page script -->
           <script>
              $(function () {
                $('#example').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            </script> 

             <script>
              $(function () {
                $('#example1').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            </script> 


           <script>
              $(function () {
                $('#example2').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            </script> 


           <script>
              $(function () {
                $('#example3').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            </script> 

           <script>
              $(function () {
                $('#example4').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": false,
                  scrollX: true,
                });
              });
            </script> 

           <script>
              $(function () {
                $('#example5').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": false,
                  scrollX: true,
                });
              });
            </script>

             <script>
              $(function () {
                $('#example6').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": false,
                  scrollX: true,
                });
              });
            </script>

             <script>
              $(function () {
                $('#example7').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": false,
                  scrollX: true,
                });
              });
            </script>

             <script>
              $(function () {
                $('#example8').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": false,
                  "info": false,
                  "autoWidth": false,
                  "responsive": false,
                  scrollX: true,
                });
              });
            </script>
  <?php } ?>
</body>

</html>