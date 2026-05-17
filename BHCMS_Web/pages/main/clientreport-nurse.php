<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(0);
include('../dbcon.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $service = $_POST['service'];

}
if ($service == "deworming") {
    $title = "DEWORMING SERVICES";
}
if ($service == "immunization") {
    $title = "IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD";
}
if ($service == "nutrition2") {
    $title = "NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION";
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

            <title>Report</title>
            <link rel="icon" href="../../img/logo.png">

            <style>
     /*       #example_wrapper {
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
            #example, #example1, #example2 thead th {
            border-top: 1px solid #000; 
            border-bottom: 1px solid #000;
            } */
            #example thead th,
            #example td {
              vertical-align: middle;
            }
            #example1 thead th,
            #example1 td {
              vertical-align: middle;
            }
            #example2 thead th,
            #example2 td {
              vertical-align: middle;
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
                                  <a href="../main/client.php" class="nav-link active">
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
                            <h4 class="font-weight-bold" style="font-family: Helvetica;">REPORT</h4>
                          </div>
                          <div class="col-2">
                          </div>
                          <div class="col-1">
                            <div class="form-group">
                              <a href="client.php" class="btn btn-dark bg-gradient-dark btn-block">Back</a>
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
                            </h5><br>

                        <form method="post">
                        <div class="card-body d-flex flex-column">
                            <div class="row align-items-center">
                              <div class="col-10">
                                <h6 class="font-weight-bold">FOR FOLLOW-UP HEALTH SERVICE:
                                </h6>
                              </div>
                          </div>


                          <?php
              if ($service == "deworming") { ?>

              <div class="card-tabs card-secondary">
                  <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold active" id="custom-tabs-one-1-4-tab" data-toggle="pill" href="#custom-tabs-one-1-4" role="tab" aria-controls="custom-tabs-one-1-4" aria-selected="true" style="padding: 10px 10px;">1-4 YEARS OLD</a>
                  </li>
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold" id="custom-tabs-one-5-9-tab" data-toggle="pill" href="#custom-tabs-one-5-9" role="tab" aria-controls="custom-tabs-one-5-9" aria-selected="false" style="padding: 10px 10px;">5-9 YEARS OLD</a>
                  </li>
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold" id="custom-tabs-one-10-19-tab" data-toggle="pill" href="#custom-tabs-one-10-19" role="tab" aria-controls="custom-tabs-one-10-19" aria-selected="false" style="padding: 10px 10px;">10-19 YEARS OLD</a>
                  </li>
                </ul>
              </div>
              
                  <?php
                  $deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service INNER JOIN client ON deworming.patientid = client.id 
      AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>

                  <br> 
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-1-4" role="tabpanel" aria-labelledby="custom-tabs-one-1-4-tab">             
                  <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 1-4 YEARS OLD
                  </h5>

                                            <table id="example" class="table table-bordered table-hover text-center">
                                              <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Registration Date</th>
                                      <th>Status</th>
                                      <th>Deworming</th>
                                      <th>Remarks</th>
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
                                  <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] == '00-00-0000') {
                                      echo '1st dose<br>  ';
                                  }
                                  if ($data['2nd_dose'] == '00-00-0000') {
                                      echo '2nd dose<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                                </div>
           
                    <div class="tab-pane fade" id="custom-tabs-one-5-9" role="tabpanel" aria-labelledby="custom-tabs-one-5-9-tab">
                    <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 5-9 YEARS OLD
                            </h5>

                        <?php
                        $deworming2nd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
            FROM $service INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>

                  <table id="example1" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Deworming</th>
                          <th>Remarks</th>
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
                                  <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] == '00-00-0000') {
                                      echo '1st dose<br>  ';
                                  }
                                  if ($data['2nd_dose'] == '00-00-0000') {
                                      echo '2nd dose<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                                </div>

                    <div class="tab-pane fade" id="custom-tabs-one-10-19" role="tabpanel" aria-labelledby="custom-tabs-one-10-19-tab">
                  <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 10-19 YEARS OLD
                  </h5>

                 <?php

                 $deworming3rd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
      purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service INNER JOIN client ON deworming.patientid = client.id 
      AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>


                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Deworming</th>
                          <th>Remarks</th>
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
                            <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                echo '<span class="badge badge-warning">Follow-up</span>';
                            } ?>
                          </td>
                          <td>
                            <?php if ($data['1st_dose'] == '00-00-0000') {
                                echo '1st dose<br>  ';
                            }
                            if ($data['2nd_dose'] == '00-00-0000') {
                                echo '2nd dose<br> ';
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo nl2br($data['remarks']); ?>
                          </td>
                        </tr>

                  <?php } ?>
                  </tbody>
                  </table>
                          </div>
                          </div>
                          </div>
            <?php } ?>


            <?php
            if ($service == "immunization") {
                $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address,
            DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
            DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
            DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
            DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
            DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
            DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
            DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
            remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
            FROM immunization INNER JOIN client ON immunization.patientid = client.id 
            WHERE bcg IS NULL OR hepab IS NULL OR dpt_hib_hepb_1stdose IS NULL OR
            dpt_hib_hepb_2nddose IS NULL OR dpt_hib_hepb_3rddose IS NULL OR opv_1stdose IS NULL OR opv_2nddose IS NULL OR
            opv_3rddose IS NULL OR pcv_1stdose IS NULL OR pcv_2nddose IS NULL OR pcv_3rddose IS NULL OR ipv IS NULL OR
            mmr1stdose IS NULL OR mmr2nddose IS NULL"); ?>



                    <table id="example" class="table table-bordered table-hover text-center">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Immunization</th>
                          <th>Remarks</th>
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
                          <?php if (
                              $data['bcgdate'] || $data['hepabdate'] || $data['dpt_hib_hepb1']
                              || $data['dpt_hib_hepb2'] || $data['dpt_hib_hepb3'] || $data['opv1']
                              || $data['opv2'] || $data['opv3'] || $data['pcv1']
                              || $data['pcv2'] || $data['pcv3'] || $data['ipvdate']
                              || $data['mmr1'] || $data['mmr2'] == '00-00-0000'
                          ) {
                              echo '<span class="badge badge-warning">Follow-up</span>';
                          } ?>
                        </td>
                        <td>
                          <?php if ($data['bcgdate'] == '00-00-0000') {
                              echo 'BCG<br>  ';
                          }
                          if ($data['hepabdate'] == '00-00-0000') {
                              echo 'Hepa B-BD<br>  ';
                          }
                          if ($data['dpt_hib_hepb1'] == '00-00-0000') {
                              echo 'DPT-HIB-HepB 1st dose<br> ';
                          }
                          if ($data['dpt_hib_hepb2'] == '00-00-0000') {
                              echo 'DPT-HIB-HepB 2nd dose<br> ';
                          }
                          if ($data['dpt_hib_hepb3'] == '00-00-0000') {
                              echo 'DPT-HIB-HepB 3rd dose<br> ';
                          }
                          if ($data['opv1'] == '00-00-0000') {
                              echo 'OPV 1st dose<br> ';
                          }
                          if ($data['opv2'] == '00-00-0000') {
                              echo 'OPV 2nd dose<br> ';
                          }
                          if ($data['opv3'] == '00-00-0000') {
                              echo 'OPV 3rd dose<br> ';
                          }
                          if ($data['pcv1'] == '00-00-0000') {
                              echo 'PCV 1st dose<br> ';
                          }
                          if ($data['pcv2'] == '00-00-0000') {
                              echo 'PCV 2nd dose<br> ';
                          }
                          if ($data['pcv3'] == '00-00-0000') {
                              echo 'PCV 3rd dose<br> ';
                          }
                          if ($data['ipvdate'] == '00-00-0000') {
                              echo 'IPV<br> ';
                          }
                          if ($data['mmr1'] == '00-00-0000') {
                              echo 'MMR dose 1<br> ';
                          }
                          if ($data['mmr2'] == '00-00-0000') {
                              echo 'MMR dose 2<br> ';
                          }
                          ?>
                        </td>
                        <td>
                        <?php 
                        if ($data['bcgdate'] == '00-00-0000') {
                            echo $data['remarks'] . '<br>';
                        }
                        if ($data['hepabdate'] == '00-00-0000') {
                            echo $data['remarks1']  . '<br>';
                        }
                        if ($data['dpt_hib_hepb1'] || $data['dpt_hib_hepb2'] || $data['dpt_hib_hepb3'] == '00-00-0000') {
                            echo $data['remarks2']  . '<br>';
                        }
                        if ($data['opv1'] || $data['opv2'] || $data['opv3'] == '00-00-0000') {
                            echo $data['remarks3']  . '<br>';
                        }
                        if ($data['pcv1'] || $data['pcv2'] || $data['pcv3'] == '00-00-0000') {
                            echo $data['remarks4']  . '<br>';
                        }
                        if ($data['ipvdate'] == '00-00-0000') {
                            echo $data['remarks5']  . '<br>';
                        }
                        if ($data['mmr1'] || $data['mmr2'] == '00-00-0000') {
                            echo $data['remarks6']  . '<br>';
                        } ?>
                        </td>
                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
                <br>
        <?php } ?>


            <?php
            if ($service == "nutrition2") {
                $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      6to11mos, 12to59mos, purok, address, 
      DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
      DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
      DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM nutrition2
      INNER JOIN client ON nutrition2.patientid = client.id
      WHERE vitamina IS NULL OR vitamin1 IS NULL OR vitamin2 IS NULL OR iron1 IS NULL OR iron2 IS NULL OR mnp1 IS NULL
      OR mnp2 IS NULL OR deworming IS NULL"); ?>


                        <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                                width="100%">
                                                <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Micronutrient Supplementation</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($nutrition2)) {

                            $status = "";
                            $service = "";

                            if ($data['6to11mos'] && $data['vitamin'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation (6-11 mos)<br>  ';
                            }
                            if ($data['6to11mos'] && $data['irondose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Iron Supplementation (6-11 mos)<br>  ';
                            }
                            if ($data['6to11mos'] && $data['mnpdose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'MNP Supplementation (6-11 mos)<br>  ';
                            }

                            if ($data['12to59mos'] && $data['vitamindose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation Dose 1 (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['vitamindose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation Dose 2 (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['irondose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Iron Supplementation (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['mnpdose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'MNP Supplementation (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['dewormings'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Deworming (12-59 mos)<br>  ';
                            }
                            ?>

                            <?php
                            if (!empty($status) || !empty($service)) {
                                ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                            <!--        <td>
                  <?php
                      if ($data['6to11mos']) {
                          echo '6-11 mos.';
                      }
                      if ($data['12to59mos']) {
                          echo '12-59 mos.';
                      }
                      ?>
                </td> -->
                                    <td>
                                      <?php echo $status; ?>
                                    </td>
                                    <td>
                                      <?php echo $service; ?>
                                    </td>
                                    <td>
                                      <?php
                                          if ($data['vitamin'] || $data['irondose1'] 
                                          || $data['mnpdose1'] == '00-00-0000') {
                                            echo nl2br($data['remarks1']);
                                          } if ($data['vitamindose1'] || $data['vitamindose2'] 
                                          || $data['irondose2'] || $data['mnpdose2'] || $data['dewormings'] == '00-00-0000') {
                                            echo nl2br($data['remarks']);
                                          }
                                          ?>
                                    </td>
                                  </tr>

                            <?php }
                        } ?>
                      </tbody>
                    </table>
                    <br>
                  </div>
            <?php } ?>


      <?php
            if ($service == "maternal") {
                $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
      DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
      DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
      DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
      DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
      DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
      DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
      DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
      DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
      syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
      DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, remarks FROM maternal 
      INNER JOIN client ON maternal.patientid = client.id 
      WHERE 
    NOT (
      (trimester1 != '00-00-0000' OR trimester1a != '00-00-0000') AND 
      (trimester2 != '00-00-0000' OR trimester2a != '00-00-0000') AND 
      (trimester3 != '00-00-0000' OR trimester3a != '00-00-0000')
    )"); ?>


                                            <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                              width="100%">
                                              <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Prenatal Visit</th>
                          <th>Remarks</th>
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
                                <?php 
                                  if (
                                    $data['tri1'] == '00-00-0000' || $data['tri1a'] == '00-00-0000' ||
                                    $data['tri2'] == '00-00-0000' || $data['tri2a'] == '00-00-0000' ||
                                    $data['tri3'] == '00-00-0000' || $data['tri3a'] == '00-00-0000'
                                  ) {
                                    echo '<span class="badge badge-warning">Follow-up</span>';
                                  }
                                  ?>

                                </td>
                                <td>
                                  <?php if ($data['tri1'] == '00-00-0000' && $data['tri1a'] == '00-00-0000') {
                                      echo 'First Trimester<br>  ';
                                  }
                                  if ($data['tri2'] == '00-00-0000' && $data['tri2a'] == '00-00-0000') {
                                      echo 'Second Trimester<br>  ';
                                  }
                                  if ($data['tri3'] == '00-00-0000' && $data['tri3a'] == '00-00-0000') {
                                      echo 'Third Trimester<br>  ';
                                  } ?>
                                </td>
                                <td>
                                  
                                <?php 
                                  if ($data['tri1'] == '00-00-0000') {
                                      echo $data['rem_tri1'] . '<br>';
                                  }
                                  if ($data['tri1a'] == '00-00-0000') {
                                      echo $data['rem_tri1a'] . '<br>';
                                  }
                                  if ($data['tri2'] == '00-00-0000') {
                                      echo $data['rem_tri2'] . '<br>';
                                  }
                                  if ($data['tri2a'] == '00-00-0000') {
                                      echo $data['rem_tri2a'] . '<br>';
                                  }
                                  if ($data['tri3'] == '00-00-0000') {
                                      echo $data['rem_tri3'] . '<br>';
                                  }
                                  if ($data['tri3a'] == '00-00-0000') {
                                      echo $data['rem_tri3a'] . '<br>';
                                  }
                                ?>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
            <?php } ?>



            <?php
            if ($service == "postpartum") {
                $postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
      DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
      DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
      DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
      DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
      DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
      DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum 
      INNER JOIN client ON postpartum.patientid = client.id 
      WHERE iron_supplementation_1stdate IS NULL OR iron_supplementation_2nddate IS NULL OR iron_supplementation_3rddate
      IS NULL OR vitamin_supplementation_date IS NULL"); ?>

                                      <table id="example" class="table table-bordered table-hover text-center">
                                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Delivery Date</th>
                          <th>Status</th>
                          <th>Micronutrient Supplementation</th>
                          <th>Remarks</th>
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
                                </td>
                                <td>
                                  <?php if (
                                      $data['iron1stdate'] || $data['iron2nddate']
                                      || $data['iron3rddate'] || $data['vitamindate'] == '00-00-0000'
                                  ) {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['iron1stdate'] == '00-00-0000') {
                                      echo '1st Iron Supplementation<br> ';
                                  }
                                  if ($data['iron2nddate'] == '00-00-0000') {
                                      echo '2nd Iron Supplementation<br> ';
                                  }
                                  if ($data['iron3rddate'] == '00-00-0000') {
                                      echo '3rd Iron Supplementation<br> ';
                                  }
                                  if ($data['vitamindate'] == '00-00-0000') {
                                      echo 'Vitamin A Supplementation<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
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

    <?php } elseif ($_SESSION['type'] == "Barangay Health Worker") {
  header("Location: ../../index.php"); } ?>


    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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
              "language": {
                "emptyTable": "No follow-up health service"
            }
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
              "language": {
                "emptyTable": "No follow-up health service"
            }
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
              "language": {
                "emptyTable": "No follow-up health service"
            }
            });
          });
</script>

  <?php } ?>

</body>

</html>