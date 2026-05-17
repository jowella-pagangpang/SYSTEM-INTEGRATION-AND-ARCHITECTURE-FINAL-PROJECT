<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $search1 = $_POST['search1'];
  $search1 = mysqli_real_escape_string($con, $search1);
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
          .button-container {
            text-align: right;
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

    $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2, length, weight, birth_weight_status, 
                  DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
                  DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
                  DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
                  DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
                  DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
                  DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
                  DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
                  remarks FROM immunization INNER JOIN client ON immunization.patientid = client.id 
                  WHERE fname LIKE '$search1' OR lname LIKE '$search1' OR CONCAT(fname, ' ', lname) LIKE '$search1'");

    $i = mysqli_num_rows($immunization);

    $deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
                    FROM deworming INNER JOIN client ON deworming.patientid = client.id 
                    WHERE fname LIKE '$search1' OR lname LIKE '$search1'
                    OR CONCAT(fname, ' ', lname) LIKE '$search1'");

    $d1 = mysqli_num_rows($deworming1st);

    $postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum INNER JOIN client ON postpartum.patientid = client.id
                    WHERE fname LIKE '$search1' OR lname LIKE '$search1' OR CONCAT(fname, ' ', lname) LIKE '$search1'");

    $p = mysqli_num_rows($postpartum);

    $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
                DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
                DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
                pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks, remarks1 FROM sickchildren 
                INNER JOIN client ON sickchildren.patientid = client.id WHERE fname LIKE '$search1' OR lname LIKE '$search1'
                OR CONCAT(fname, ' ', lname) LIKE '$search1'");

    $sc = mysqli_num_rows($sickchildren);

    $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
                      DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
                      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
                DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
                DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 
                INNER JOIN client ON nutrition2.patientid = client.id WHERE fname LIKE '$search1' OR lname LIKE '$search1'
                OR CONCAT(fname, ' ', lname) LIKE '$search1'");

    $n2 = mysqli_num_rows($nutrition2);

    $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                   DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
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
                  outcome, gender, birth_weight, facility, nid, attended, remarks FROM maternal 
                  INNER JOIN client ON maternal.patientid = client.id WHERE fname LIKE '$search1' OR lname LIKE '$search1'
                  OR CONCAT(fname, ' ', lname) LIKE '$search1'");

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
                                                <a href="../immunization/immunization.php" class="nav-link  <?php echo (isset($i) && $i > 0) ? 'active' : ''; ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Immunization Services</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../deworming1/deworming1-4.php" class="nav-link  <?php echo (isset($d1) && $d1 > 0) ||  (isset($d2) && $d2 > 0) || (isset($d3) && $d3 > 0) ? 'active' : ''; ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Deworming Services</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="../nutrition2/nutrition2.php" class="nav-link <?php echo (isset($n2) && $n2 > 0) ? 'active' : ''; ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Nutrition Program</p>
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
                                <h4 class="font-weight-bold" style="font-family: Helvetica;"
                >               Search result for '<?php echo $search1 ?>':
                                  </h4>
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

    if ($i > 0) {
      ?>

            <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD
                    </h6>

                    <form method="post">
                      <div class="card-body d-flex flex-column">
                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            while ($data = mysqli_fetch_array($immunization)) { ?>

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
                                <div class="button-container">
                                  <a href="../client/immunization-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> View
                                    </button>
                                  </a>
                                </div>
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
                if ($d1 > 0) {
                  ?>
                  <section class="content text-sm" style="font-family: Helvetica;">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <br>
                          <h6 class="font-weight-bold text-left">DEWORMING SERVICES</h6>

                          <form method="post">
                            <div class="card-body d-flex flex-column">
                              <br>
                              <table id="example" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Date of Registration</th>
                                    <th>Sex</th>
                                    <th></th>
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
                                <div class="button-container">
                                    <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
                                      <button type="button" class="btn btn-primary btn-sm">
                                        <i class="nav-icon fas fa-eye"></i> View</button>
                                    </a>
                                </div>
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
                    <h6 class="font-weight-bold text-left">NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION</h6>

                    <form method="post">
                      <div class="card-body d-flex flex-column">


                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
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
                                <div class="button-container">
                                    <a href="../client/nutrition2-record.php?id=<?php echo $data['patientid']; ?>">
                                      <button type="button" class="btn btn-primary btn-sm">
                                        <i class="nav-icon fas fa-eye"></i> View</button>
                                    </a>
                                </div>
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
    if ($sc > 0) {
      ?>
            <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">

                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">SICK CHILDREN</h6>

                    <form method="post">
                      <div class="card-body d-flex flex-column">

                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Date of Registration</th>
                              <th>Sex</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while ($data = mysqli_fetch_array($sickchildren)) { ?>
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
                                <div class="button-container">
                                    <a href="../client/sickchildren-record.php?id=<?php echo $data['patientid']; ?>">
                                      <button type="button" class="btn btn-primary btn-sm">
                                        <i class="nav-icon fas fa-eye"></i> View</button>
                                    </a>
                                </div>
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
        if ($m > 0) {
          ?>

                  <section class="content text-sm" style="font-family: Helvetica;">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <br>
                          <h6 class="font-weight-bold text-left">MATERNAL CARE
                          </h6>

                          <form method="post">
                            <div class="card-body d-flex flex-column">
                              <br>
                              <table id="example" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Date of Registration</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  while ($data = mysqli_fetch_array($maternal)) { ?>

                                <tr>
                                  <td>
                                    <?php echo $data['fullname']; ?>
                                  </td>
                                  <td>
                                    <?php echo $data['regdate']; ?>
                                  </td>
                          <td>
                        <div class="button-container">
                            <a href="../client/maternal-record.php?id=<?php echo $data['patientid']; ?>">
                              <button type="button" class="btn btn-primary btn-sm">
                                <i class="nav-icon fas fa-eye"></i> View</button>
                            </a>
                        </div>
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
        if ($p > 0) {
          ?>
            <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">

                  <div class="card">
                    <br>
                    <h6 class="font-weight-bold text-left">POSTPARTUM CARE</h6>

                    <form method="post">
                      <div class="card-body d-flex flex-column">

                        <br>
                        <table id="example" class="table table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Date and Time of Delivery</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            while ($data = mysqli_fetch_array($postpartum)) { ?>

                                <tr>
                                  <td>
                                    <?php echo $data['fullname']; ?>
                                  </td>
                                  <td>
                                    <?php echo $data['deliverydate']; ?>
                                    <?php echo $data['delivery_time']; ?>
                                  </td>
                                  <td>
                                <div class="button-container">
                                    <a href="../client/postpartum-record.php?id=<?php echo $data['patientid']; ?>">
                                      <button type="button" class="btn btn-primary btn-sm">
                                        <i class="nav-icon fas fa-eye"></i> View</button>
                                    </a>
                                </div>
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
            if ($d1 < 1 && $p < 1 && $sc < 1 && $n2 < 1 && $m < 1 && $i < 1) {
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