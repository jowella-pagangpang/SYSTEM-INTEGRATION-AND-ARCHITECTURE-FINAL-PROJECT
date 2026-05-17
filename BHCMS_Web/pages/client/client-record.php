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

        <title>Client History</title>
        <link rel="icon" href="../../img/logo.png">
        <link rel="stylesheet" href="styles.css">

        <style type="text/css">

            h6 {
              font-size: 1.1em;
            }

             #example td {
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
                      <div class="col-11">
                        <h4 class="font-weight-bold" style="font-family: Helvetica;">HISTORICAL DATA</h4>
                      </div>
                        <div class="col-1 text-right">
                            <a href="client-list.php" class="btn btn-dark btn-sm">
                                <i class="nav-icon fas fa-times"></i></a>
                        </div>
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <section class="content text-sm" style="font-family: Helvetica;">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">

                      <?php
                  $id = $_GET['id'];
                  $data = mysqli_query($con, "SELECT id, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress FROM client WHERE id = '$id'");
                  $row = mysqli_fetch_assoc($data);

                  $birthdate = $row['birthdate'];
                  $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);
                  
                  if ($birthDateObj === false) {
                      echo "Failed to parse the birthdate.";
                  } else {
                      $currentDateObj = new DateTime();
                      $age = $birthDateObj->diff($currentDateObj);

                      $years = $age->y;
                      $months = $age->m;

                  ?>

              <form method="post">
                <div class="card-body d-flex flex-column">
                      <div class="card-block">
                        <div class="row">
                          <div class="col-6">                
                          <h5 class="font-weight-bold">
                            <?php echo $row['fullname']; ?>
                          </h5>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="card-block">
                        <div class="row">
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Client ID 
                          </h6>    
                          <h6>
                            <?php echo $row['id']; ?>
                          </h6>
                        </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Date of Birth 
                          </h6>   
                          <h6>
                            <?php echo $row['birthdate']; ?>
                          </h6>
                          </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Sex 
                          </h6>   
                          <h6>
                            <?php echo $row['sex']; ?>
                          </h6>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="card-block">
                        <div class="row">
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Name of Mother 
                          </h6>   
                          <h6>
                            <?php echo $row['mother_name']; ?>
                          </h6>
                        </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Complete Address 
                          </h6>   
                          <h6>
                            <?php echo $row['caddress']; ?>
                          </h6>
                          </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Age 
                          </h6>   
                          <h6>
                          <?php 
                              if ($years == 0) {
                                  if ($months == 1) {
                                      echo "1 month";
                                  } elseif ($months == 0) {
                                      echo "0 month";
                                  } else {
                                      echo "$months months";
                                  }
                              } elseif ($years == 1) {
                                  if ($months == 1) {
                                      echo "1 year old";
                                  } elseif ($months == 0) {
                                      echo "1 year old";
                                  } else {
                                      echo "1 year old";
                                  }
                              } else {
                                  if ($months == 1) {
                                      echo "$years years old";
                                  } elseif ($months == 0) {
                                      echo "$years years old";
                                  } else {
                                      echo "$years years old";
                                  }
                              }
                          }
                        ?>
                          </h6>
                          </div>
                        </div>
                      </div>

                    <br><br>

      
<?php

$immunization = mysqli_query($con, "SELECT id, immunization_id, patientid, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
    DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
    DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
    DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
    DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
    DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
    DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2 FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE patientid = $id ORDER BY bcgdate DESC, hepabdate DESC, dpt_hib_hepb1 DESC, dpt_hib_hepb2 DESC, dpt_hib_hepb3 DESC, opv1 DESC, opv2 DESC, opv3 DESC, pcv1 DESC, pcv2 DESC, pcv3 DESC, ipvdate DESC, mmr1 DESC, mmr2 DESC;");

$i = mysqli_num_rows($immunization);

$nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, 6to11mos, 12to59mos, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
    DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
    DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
    DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id WHERE patientid = $id ORDER BY GREATEST(vitamina, vitamin1, vitamin2, iron1, iron2, mnp1, mnp2, deworming) DESC;");

$n = mysqli_num_rows($nutrition2);

$deworming1st = mysqli_query($con, "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
    remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
    WHERE patientid = $id ORDER BY 1stdose DESC, 2nddose DESC;");

$d = mysqli_num_rows($deworming1st);

$sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    fname, minitial, lname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    sex, mother_name, purok, address, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
    DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
    pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks FROM sickchildren 
    INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id ORDER BY regdate DESC, vitamindate DESC, orsdate DESC, oralzincdate DESC, pneumoniadate DESC;");

$s = mysqli_num_rows($sickchildren);

$consult = mysqli_query($con, "SELECT consult_id, patientid, 
    DATE_FORMAT(date,'%m-%d-%Y') AS consultdate, weight, diagnosis, 
    treatment, remarks FROM consultation
    INNER JOIN client ON consultation.patientid = client.id WHERE consultation.patientid = $id ORDER BY consultdate DESC;");

$c = mysqli_num_rows($consult);

$maternal = mysqli_query($con, "SELECT maternal_id, patientid, 
    DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
    outcome, gender, birth_weight, facility, nid, attended, remarks 
    FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY terminated_date DESC;");

$m = mysqli_num_rows($maternal); 

$postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate FROM postpartum 
    INNER JOIN client ON postpartum.patientid = client.id WHERE patientid = $id ORDER BY GREATEST(delivery_date, iron_supplementation_1stdate, iron_supplementation_2nddate, iron_supplementation_3rddate, vitamin_supplementation_date) DESC;");

$p = mysqli_num_rows($postpartum);

?>
 


    <?php if($c > 0) { ?>

      <table id="example" class="table table-bordered table-hover text-center" width="100%">
                              <thead class="bg-light color-palette">
                              <tr class="bg-lightblue color-palette">
                                <th colspan="3" class="text-left">CONSULTATION INFORMATION</th>
                              </tr>
                                <tr>
                                  <th>Date</th>
                                  <th>Diagnosis</th>
                                  <th>Treatment</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($consult)) { ?>

                                    <tr>
                                      <td>
                                        <?php echo $data['consultdate']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['diagnosis']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['treatment']; ?>
                                      </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
          <br>
      <?php } ?>


<?php if ($s > 0) {
    $data = mysqli_fetch_array($sickchildren);
    if ($data['regdate'] !== '00-00-0000' && $data['se_status'] !== '') {
        $displayTable = false;

        if ($data['vitamindate'] !== '00-00-0000') {
            $displayTable = true;
        }

        if (($data['orsdate'] !== '00-00-0000' || $data['oralzincdate'] !== '00-00-0000')) {
            $displayTable = true;
        }

        if ($data['pneumoniadate'] !== '00-00-0000') {
            $displayTable = true;
        }

        if ($displayTable) {
            ?>
            <table id="example" class="table table-bordered table-hover text-center" width="100%">
                <thead class="bg-light color-palette">
                    <tr class="bg-lightblue color-palette">
                        <th colspan="5" class="text-left">SUPPLEMENTATION AND TREATMENT</th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th colspan="3" scope="colgroup">Date Given Treatment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data['vitamindate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Vitamin A Supplementation</th>
                            <td colspan="2"><?= $data['vitamindate']; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($data['orsdate'] !== '00-00-0000' || $data['oralzincdate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Diarrhea Cases Seen</th>
                            <td><?= $data['orsdate'] !== '00-00-0000' ? $data['orsdate'] : ''; ?></td>
                            <td><?= $data['oralzincdate'] !== '00-00-0000' ? $data['oralzincdate'] : ''; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($data['pneumoniadate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Pneumonia Cases Seen</th>
                            <td colspan="2"><?= $data['pneumoniadate']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        <?php }
    }
} ?>


<!-- POSTPARTUM -->


<?php if($p > 0) {  ?>

  <table id="example" class="table table-bordered table-hover text-center">
                          <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="5" class="text-left">POSTPARTUM CARE</th>
            </tr>
                            <tr>
                              <th rowspan="2">Date and Time of Delivery</th>
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
                                </tr>

                            <?php } ?>

                          </tbody>
                      </table>
                      <br>
                    <?php } ?>


<!-- MATERNAL -->

      <?php if($m > 0) {  ?>
                    
                      <table id="example" class="table table-bordered table-hover text-center" width="100%">
                <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="6" class="text-left">PREGNANCY AND LIVEBIRTHS</th>
            </tr>
            <tr>
                <th rowspan="2">Date Terminated</th>
                <th rowspan="2">Outcome / <br>Gender (M/F)</th>
                <th rowspan="2" class="font-weight-normal"><b>Birth Weight</b> <br>(grams)</th>
                <th colspan="2">Place of Delivery</th>
                <th rowspan="2">Attended by</th>
            </tr>
            <tr>
                <th>Health Facility</th>
                <th>NID</th>
            </tr>
        </thead>
        <tbody>

        <?php
            while ($data = mysqli_fetch_array($maternal)) {
                if ($data['terminated_date'] || $data['outcome'] || $data['gender'] || $data['birth_weight'] || $data['facility'] || $data['nid'] || $data['attended']) {
            ?>
                <tr>
                    <td><?php if ($data['terminated_date'] != '00-00-0000') echo $data['terminated_date']; ?></td>
                    <td>
                        <?php echo $data['outcome']; ?> <br>
                        <?php echo $data['gender']; ?>
                    </td>
                    <td>
                        <?php if ($data['birth_weight'] > 0) echo $data['birth_weight']; ?>
                    </td>
                    <td><?php echo $data['facility']; ?></td>
                    <td><?php echo $data['nid']; ?></td>
                    <td><?php echo $data['attended']; ?></td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <br>
<?php } ?>



<!-- DEWORMING -->

    <?php if ($d > 0) { ?>

                <table id="example" class="table table-bordered table-hover text-center">
                  <thead class="bg-light color-palette">
                    <tr class="bg-lightblue color-palette">
                      <th colspan="2" class="text-left">DEWORMING SERVICES</th>
                    </tr>
                    <tr>
                      <th>1st Dose</th>
                      <th>2nd Dose</th>
                    </tr>
                  </thead>
                  <tbody>

          <?php while ($data = mysqli_fetch_array($deworming1st)) { ?>

            <tr>
            <?php if ($data['1st_dose'] != '00-00-0000') { ?>
              <td><?= $data['1st_dose']; ?></td>
            <?php } ?>
            
            <?php if ($data['2nd_dose'] != '00-00-0000') { ?>
              <td><?= $data['2nd_dose']; ?></td>
            <?php } ?>
            </tr>
<?php } ?>
        </tbody>
        </table>
        <br>
    <?php } ?>



<!-- NUTRITION -->
             
<?php
$display6to11mos = false;
$display12to59mos = false;

if ($n > 0) {
    $dataArray = array(); // Create an array to store the data

    // Fetch the data once and store it in an array
    while ($data = mysqli_fetch_array($nutrition2)) {
        $dataArray[] = $data;
    }

    // Determine which age group to display
    foreach ($dataArray as $data) {
        if (isset($data['vitamin']) && $data['vitamin'] != '00-00-0000') {
            $display6to11mos = true;
        }

        if (isset($data['vitamindose1'], $data['vitamindose2'], $data['irondose2'], $data['mnpdose2'], $data['dewormings'])) {
            if ($data['vitamindose1'] != '00-00-0000' || $data['vitamindose2'] != '00-00-0000' || $data['irondose2'] != '00-00-0000' || $data['mnpdose2'] != '00-00-0000' || $data['dewormings'] != '00-00-0000') {
                $display12to59mos = true;
            }
        }
    }
?>
      <table id="example" class="table table-bordered table-hover text-center" width="100%">
        <thead class="bg-light color-palette">
          <tr class="bg-lightblue color-palette">
            <th colspan="5" class="text-left">NUTRITION SERVICES</th>
          </tr>
          <tr>
            <th rowspan="2">Micronutrient Supplementation</th>
            <th colspan="3" scope="colgroup">Date Given (<?= $display6to11mos ? '6 to 11 months' : '12 to 59 months' ?>)
            </th>
          </tr>
        </thead>

        <tbody>
          <?php
          if ($display6to11mos) {
            // Display values from 6to11mos
            foreach ($dataArray as $data) {
              if ($data['vitamin'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Vitamin A</th>
                  <td>
                    <?= $data['vitamin']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['irondose1'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Iron</th>
                  <td>
                    <?= $data['irondose1']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['mnpdose1'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">MNP</th>
                  <td>
                    <?= $data['mnpdose1']; ?>
                  </td>
                </tr>
                <?php
              }
            }
          } elseif ($display12to59mos) {
            // Display values from 12to59mos
            foreach ($dataArray as $data) {
              if ($data['vitamindose1'] != '00-00-0000' || $data['vitamindose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Vitamin A</th>
                  <td>
                    <?= $data['vitamindose1']; ?>
                  </td>
                  <td>
                    <?= $data['vitamindose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['irondose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Iron</th>
                  <td colspan="2">
                    <?= $data['irondose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['mnpdose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">MNP</th>
                  <td colspan="2">
                    <?= $data['mnpdose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['dewormings'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Deworming</th>
                  <td colspan="2">
                    <?= $data['dewormings']; ?>
                  </td>
                </tr>
                <?php
              }
            }
          }
          ?>
        </tbody>
      </table>
      <br>
    <?php } ?>


<!-- IMMUNIZATION -->
                   
<?php if ($i > 0) { ?>

    <table id="example" class="table table-bordered table-hover text-center" width="100%">

        <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="5" class="text-left">IMMUNIZATION SERVICES</th>
            </tr>
            <tr>
                <th rowspan="2">Vaccine</th>
                <th>Doses Received</th>
                <th colspan="3" scope="colgroup">Date Given</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $data_array = array();
            while ($data = mysqli_fetch_array($immunization)) {
                $data_array[] = $data;
            }

            foreach (array_reverse($data_array) as $data) {
                $bcgCount = 0;
                $hepabCount = 0;
                $dptCount = 0;
                $opvCount = 0;
                $pcvCount = 0;
                $ipvCount = 0;
                $mmrCount = 0;

          if ($data['mmr1'] != '00-00-0000' || $data['mmr2'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>MMR</b> <br>(Measles, mumps, and rubella)</th>
                  <?php
                  $mmrCount = ($data['mmr1'] != '00-00-0000' ? 1 : 0) +
                      ($data['mmr2'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $mmrCount; ?></td>
                  <td><?= $data['mmr1'] != '00-00-0000' ? $data['mmr1'] : ''; ?></td>
                  <td colspan="2"><?= $data['mmr2'] != '00-00-0000' ? $data['mmr2'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['ipvdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>IPV</b> <br>(Inactivated Polio Vaccine)</th>
                  <?php
                  $ipvCount = ($data['ipvdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $ipvCount; ?></td>
                  <td colspan="3"><?= $data['ipvdate']; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['pcv1'] != '00-00-0000' || $data['pcv2'] != '00-00-0000' || $data['pcv3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>PCV</b> <br>(Pneumococcal Conjugate Vaccine)</th>
                  <?php
                  $pcvCount = ($data['pcv1'] != '00-00-0000' ? 1 : 0) +
                      ($data['pcv2'] != '00-00-0000' ? 1 : 0) +
                      ($data['pcv3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $pcvCount; ?></td>
                  <td><?= $data['pcv1'] != '00-00-0000' ? $data['pcv1'] : ''; ?></td>
                  <td><?= $data['pcv2'] != '00-00-0000' ? $data['pcv2'] : ''; ?></td>
                  <td><?= $data['pcv3'] != '00-00-0000' ? $data['pcv3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['opv1'] != '00-00-0000' || $data['opv2'] != '00-00-0000' || $data['opv3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>OPV</b> <br>(Oral Polio Vaccine)</th>
                  <?php
                  $opvCount = ($data['opv1'] != '00-00-0000' ? 1 : 0) +
                      ($data['opv2'] != '00-00-0000' ? 1 : 0) +
                      ($data['opv3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $opvCount; ?></td>
                  <td><?= $data['opv1'] != '00-00-0000' ? $data['opv1'] : ''; ?></td>
                  <td><?= $data['opv2'] != '00-00-0000' ? $data['opv2'] : ''; ?></td>
                  <td><?= $data['opv3'] != '00-00-0000' ? $data['opv3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['dpt_hib_hepb1'] != '00-00-0000' || $data['dpt_hib_hepb2'] != '00-00-0000' || $data['dpt_hib_hepb3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>DPT-HIB-HepB</b> <br>(Pentavalent vaccine)</th>
                  <?php
                  $dptCount = ($data['dpt_hib_hepb1'] != '00-00-0000' ? 1 : 0) +
                      ($data['dpt_hib_hepb2'] != '00-00-0000' ? 1 : 0) +
                      ($data['dpt_hib_hepb3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $dptCount; ?></td>
                  <td><?= $data['dpt_hib_hepb1'] != '00-00-0000' ? $data['dpt_hib_hepb1'] : ''; ?></td>
                  <td><?= $data['dpt_hib_hepb2'] != '00-00-0000' ? $data['dpt_hib_hepb2'] : ''; ?></td>
                  <td><?= $data['dpt_hib_hepb3'] != '00-00-0000' ? $data['dpt_hib_hepb3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['hepabdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>Hepa B-BD</b> <br>(Hepatitis B)</th>
                  <?php
                  $hepabCount = ($data['hepabdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $hepabCount; ?></td>
                  <td colspan="3"><?= $data['hepabdate']; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['bcgdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>BCG</b> <br>(Bacillus Calmette-Guérin)</th>
                  <?php
                  $bcgCount = ($data['bcgdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $bcgCount; ?></td>
                  <td colspan="3"><?= $data['bcgdate']; ?></td>
              </tr>
          <?php } ?>

            <?php } ?>
        </tbody>
    </table>
    <br>
<?php } ?>
         


</div>

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


          <script src="script.js"></script>

          <!-- DataTables -->
          <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
          <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

          <!-- page script -->
  <script>
     
  $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            </script>
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





            <?php } elseif ($_SESSION['type'] == "Nurse") { ?>
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
                                <a href="../client/client-list.php" class="nav-link active">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Client
                                    </p>
                                </a>
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
                        <h4 class="font-weight-bold" style="font-family: Helvetica;">HISTORICAL DATA</h4>
                      </div>
                        <div class="col-1 text-right">
                            <a href="client-list.php" class="btn btn-dark btn-sm">
                                <i class="nav-icon fas fa-times"></i></a>
                        </div>
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <section class="content text-sm" style="font-family: Helvetica;">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">

                      <?php
                  $id = $_GET['id'];
                  $data = mysqli_query($con, "SELECT id, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress FROM client WHERE id = '$id'");
                  $row = mysqli_fetch_assoc($data);

                  $birthdate = $row['birthdate'];
                  $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);
                  
                  if ($birthDateObj === false) {
                      echo "Failed to parse the birthdate.";
                  } else {
                      $currentDateObj = new DateTime();
                      $age = $birthDateObj->diff($currentDateObj);

                      $years = $age->y;
                      $months = $age->m;

                  ?>

              <form method="post">
                <div class="card-body d-flex flex-column">
                      <div class="card-block">
                        <div class="row">
                          <div class="col-6">                
                          <h5 class="font-weight-bold">
                            <?php echo $row['fullname']; ?>
                          </h5>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="card-block">
                        <div class="row">
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                          Client ID 
                          </h6>    
                          <h6>
                            <?php echo $row['id']; ?>
                          </h6>
                        </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Date of Birth 
                          </h6>   
                          <h6>
                            <?php echo $row['birthdate']; ?>
                          </h6>
                          </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Sex 
                          </h6>   
                          <h6>
                            <?php echo $row['sex']; ?>
                          </h6>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="card-block">
                        <div class="row">
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Name of Mother 
                          </h6>   
                          <h6>
                            <?php echo $row['mother_name']; ?>
                          </h6>
                        </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Complete Address 
                          </h6>   
                          <h6>
                            <?php echo $row['caddress']; ?>
                          </h6>
                          </div>
                          <div class="col-4">                
                          <h6 class="font-weight-bold">
                            Age 
                          </h6>   
                          <h6>
                          <?php 
                              if ($years == 0) {
                                  if ($months == 1) {
                                      echo "1 month";
                                  } elseif ($months == 0) {
                                      echo "0 month";
                                  } else {
                                      echo "$months months";
                                  }
                              } elseif ($years == 1) {
                                  if ($months == 1) {
                                      echo "1 year old";
                                  } elseif ($months == 0) {
                                      echo "1 year old";
                                  } else {
                                      echo "1 year old";
                                  }
                              } else {
                                  if ($months == 1) {
                                      echo "$years years old";
                                  } elseif ($months == 0) {
                                      echo "$years years old";
                                  } else {
                                      echo "$years years old";
                                  }
                              }
                          }
                        ?>
                          </h6>
                          </div>
                        </div>
                      </div>

                    <br><br>

      
<?php

$immunization = mysqli_query($con, "SELECT id, immunization_id, patientid, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
    DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
    DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
    DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
    DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
    DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
    DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2 FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE patientid = $id ORDER BY bcgdate DESC, hepabdate DESC, dpt_hib_hepb1 DESC, dpt_hib_hepb2 DESC, dpt_hib_hepb3 DESC, opv1 DESC, opv2 DESC, opv3 DESC, pcv1 DESC, pcv2 DESC, pcv3 DESC, ipvdate DESC, mmr1 DESC, mmr2 DESC;");

$i = mysqli_num_rows($immunization);

$nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, 6to11mos, 12to59mos, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
    DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
    DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
    DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id WHERE patientid = $id ORDER BY GREATEST(vitamina, vitamin1, vitamin2, iron1, iron2, mnp1, mnp2, deworming) DESC;");

$n = mysqli_num_rows($nutrition2);

$deworming1st = mysqli_query($con, "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
    remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
    WHERE patientid = $id ORDER BY 1stdose DESC, 2nddose DESC;");

$d = mysqli_num_rows($deworming1st);

$sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    fname, minitial, lname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    sex, mother_name, purok, address, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
    DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
    pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks FROM sickchildren 
    INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id ORDER BY regdate DESC, vitamindate DESC, orsdate DESC, oralzincdate DESC, pneumoniadate DESC;");

$s = mysqli_num_rows($sickchildren);

$consult = mysqli_query($con, "SELECT consult_id, patientid, 
    DATE_FORMAT(date,'%m-%d-%Y') AS consultdate, weight, diagnosis, 
    treatment, remarks FROM consultation
    INNER JOIN client ON consultation.patientid = client.id WHERE consultation.patientid = $id ORDER BY consultdate DESC;");

$c = mysqli_num_rows($consult);

$maternal = mysqli_query($con, "SELECT maternal_id, patientid, 
    DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
    outcome, gender, birth_weight, facility, nid, attended, remarks 
    FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY terminated_date DESC;");

$m = mysqli_num_rows($maternal); 

$postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate FROM postpartum 
    INNER JOIN client ON postpartum.patientid = client.id WHERE patientid = $id ORDER BY GREATEST(delivery_date, iron_supplementation_1stdate, iron_supplementation_2nddate, iron_supplementation_3rddate, vitamin_supplementation_date) DESC;");

$p = mysqli_num_rows($postpartum);

?>
 


    <?php if($c > 0) { ?>

      <table id="example" class="table table-bordered table-hover text-center" width="100%">
                              <thead class="bg-light color-palette">
                              <tr class="bg-lightblue color-palette">
                                <th colspan="3" class="text-left">CONSULTATION INFORMATION</th>
                              </tr>
                                <tr>
                                  <th>Date</th>
                                  <th>Diagnosis</th>
                                  <th>Treatment</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($consult)) { ?>

                                    <tr>
                                      <td>
                                        <?php echo $data['consultdate']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['diagnosis']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['treatment']; ?>
                                      </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
          <br>
      <?php } ?>


<?php if ($s > 0) {
    $data = mysqli_fetch_array($sickchildren);
    if ($data['regdate'] !== '00-00-0000' && $data['se_status'] !== '') {
        $displayTable = false;

        if ($data['vitamindate'] !== '00-00-0000') {
            $displayTable = true;
        }

        if (($data['orsdate'] !== '00-00-0000' || $data['oralzincdate'] !== '00-00-0000')) {
            $displayTable = true;
        }

        if ($data['pneumoniadate'] !== '00-00-0000') {
            $displayTable = true;
        }

        if ($displayTable) {
            ?>
            <table id="example" class="table table-bordered table-hover text-center" width="100%">
                <thead class="bg-light color-palette">
                    <tr class="bg-lightblue color-palette">
                        <th colspan="5" class="text-left">SUPPLEMENTATION AND TREATMENT</th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th colspan="3" scope="colgroup">Date Given Treatment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data['vitamindate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Vitamin A Supplementation</th>
                            <td colspan="2"><?= $data['vitamindate']; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($data['orsdate'] !== '00-00-0000' || $data['oralzincdate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Diarrhea Cases Seen</th>
                            <td><?= $data['orsdate'] !== '00-00-0000' ? $data['orsdate'] : ''; ?></td>
                            <td><?= $data['oralzincdate'] !== '00-00-0000' ? $data['oralzincdate'] : ''; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($data['pneumoniadate'] !== '00-00-0000') { ?>
                        <tr>
                            <th scope="row">Pneumonia Cases Seen</th>
                            <td colspan="2"><?= $data['pneumoniadate']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        <?php }
    }
} ?>


<!-- POSTPARTUM -->


<?php if($p > 0) {  ?>

  <table id="example" class="table table-bordered table-hover text-center">
                          <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="5" class="text-left">POSTPARTUM CARE</th>
            </tr>
                            <tr>
                              <th rowspan="2">Date and Time of Delivery</th>
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
                                </tr>

                            <?php } ?>

                          </tbody>
                      </table>
                      <br>
                    <?php } ?>


<!-- MATERNAL -->

      <?php if($m > 0) {  ?>
                    
                      <table id="example" class="table table-bordered table-hover text-center" width="100%">
                <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="6" class="text-left">PREGNANCY AND LIVEBIRTHS</th>
            </tr>
            <tr>
                <th rowspan="2">Date Terminated</th>
                <th rowspan="2">Outcome / <br>Gender (M/F)</th>
                <th rowspan="2" class="font-weight-normal"><b>Birth Weight</b> <br>(grams)</th>
                <th colspan="2">Place of Delivery</th>
                <th rowspan="2">Attended by</th>
            </tr>
            <tr>
                <th>Health Facility</th>
                <th>NID</th>
            </tr>
        </thead>
        <tbody>

        <?php
            while ($data = mysqli_fetch_array($maternal)) {
                if ($data['terminated_date'] || $data['outcome'] || $data['gender'] || $data['birth_weight'] || $data['facility'] || $data['nid'] || $data['attended']) {
            ?>
                <tr>
                    <td><?php if ($data['terminated_date'] != '00-00-0000') echo $data['terminated_date']; ?></td>
                    <td>
                        <?php echo $data['outcome']; ?> <br>
                        <?php echo $data['gender']; ?>
                    </td>
                    <td>
                        <?php if ($data['birth_weight'] > 0) echo $data['birth_weight']; ?>
                    </td>
                    <td><?php echo $data['facility']; ?></td>
                    <td><?php echo $data['nid']; ?></td>
                    <td><?php echo $data['attended']; ?></td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <br>
<?php } ?>



<!-- DEWORMING -->

    <?php if ($d > 0) { ?>

                <table id="example" class="table table-bordered table-hover text-center">
                  <thead class="bg-light color-palette">
                    <tr class="bg-lightblue color-palette">
                      <th colspan="2" class="text-left">DEWORMING SERVICES</th>
                    </tr>
                    <tr>
                      <th>1st Dose</th>
                      <th>2nd Dose</th>
                    </tr>
                  </thead>
                  <tbody>

          <?php while ($data = mysqli_fetch_array($deworming1st)) { ?>

            <tr>
            <?php if ($data['1st_dose'] != '00-00-0000') { ?>
              <td><?= $data['1st_dose']; ?></td>
            <?php } ?>
            
            <?php if ($data['2nd_dose'] != '00-00-0000') { ?>
              <td><?= $data['2nd_dose']; ?></td>
            <?php } ?>
            </tr>
<?php } ?>
        </tbody>
        </table>
        <br>
    <?php } ?>



<!-- NUTRITION -->
             
<?php
$display6to11mos = false;
$display12to59mos = false;

if ($n > 0) {
    $dataArray = array(); // Create an array to store the data

    // Fetch the data once and store it in an array
    while ($data = mysqli_fetch_array($nutrition2)) {
        $dataArray[] = $data;
    }

    // Determine which age group to display
    foreach ($dataArray as $data) {
        if (isset($data['vitamin']) && $data['vitamin'] != '00-00-0000') {
            $display6to11mos = true;
        }

        if (isset($data['vitamindose1'], $data['vitamindose2'], $data['irondose2'], $data['mnpdose2'], $data['dewormings'])) {
            if ($data['vitamindose1'] != '00-00-0000' || $data['vitamindose2'] != '00-00-0000' || $data['irondose2'] != '00-00-0000' || $data['mnpdose2'] != '00-00-0000' || $data['dewormings'] != '00-00-0000') {
                $display12to59mos = true;
            }
        }
    }
?>
      <table id="example" class="table table-bordered table-hover text-center" width="100%">
        <thead class="bg-light color-palette">
          <tr class="bg-lightblue color-palette">
            <th colspan="5" class="text-left">NUTRITION SERVICES</th>
          </tr>
          <tr>
            <th rowspan="2">Micronutrient Supplementation</th>
            <th colspan="3" scope="colgroup">Date Given (<?= $display6to11mos ? '6 to 11 months' : '12 to 59 months' ?>)
            </th>
          </tr>
        </thead>

        <tbody>
          <?php
          if ($display6to11mos) {
            // Display values from 6to11mos
            foreach ($dataArray as $data) {
              if ($data['vitamin'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Vitamin A</th>
                  <td>
                    <?= $data['vitamin']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['irondose1'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Iron</th>
                  <td>
                    <?= $data['irondose1']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['mnpdose1'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">MNP</th>
                  <td>
                    <?= $data['mnpdose1']; ?>
                  </td>
                </tr>
                <?php
              }
            }
          } elseif ($display12to59mos) {
            // Display values from 12to59mos
            foreach ($dataArray as $data) {
              if ($data['vitamindose1'] != '00-00-0000' || $data['vitamindose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Vitamin A</th>
                  <td>
                    <?= $data['vitamindose1']; ?>
                  </td>
                  <td>
                    <?= $data['vitamindose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['irondose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Iron</th>
                  <td colspan="2">
                    <?= $data['irondose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['mnpdose2'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">MNP</th>
                  <td colspan="2">
                    <?= $data['mnpdose2']; ?>
                  </td>
                </tr>
                <?php
              }
              if ($data['dewormings'] != '00-00-0000') {
                ?>
                <tr>
                  <th scope="row">Deworming</th>
                  <td colspan="2">
                    <?= $data['dewormings']; ?>
                  </td>
                </tr>
                <?php
              }
            }
          }
          ?>
        </tbody>
      </table>
      <br>
    <?php } ?>


<!-- IMMUNIZATION -->
                   
<?php if ($i > 0) { ?>

    <table id="example" class="table table-bordered table-hover text-center" width="100%">

        <thead class="bg-light color-palette">
            <tr class="bg-lightblue color-palette">
                <th colspan="5" class="text-left">IMMUNIZATION SERVICES</th>
            </tr>
            <tr>
                <th rowspan="2">Vaccine</th>
                <th>Doses Received</th>
                <th colspan="3" scope="colgroup">Date Given</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $data_array = array();
            while ($data = mysqli_fetch_array($immunization)) {
                $data_array[] = $data;
            }

            foreach (array_reverse($data_array) as $data) {
                $bcgCount = 0;
                $hepabCount = 0;
                $dptCount = 0;
                $opvCount = 0;
                $pcvCount = 0;
                $ipvCount = 0;
                $mmrCount = 0;

          if ($data['mmr1'] != '00-00-0000' || $data['mmr2'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>MMR</b> <br>(Measles, mumps, and rubella)</th>
                  <?php
                  $mmrCount = ($data['mmr1'] != '00-00-0000' ? 1 : 0) +
                      ($data['mmr2'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $mmrCount; ?></td>
                  <td><?= $data['mmr1'] != '00-00-0000' ? $data['mmr1'] : ''; ?></td>
                  <td colspan="2"><?= $data['mmr2'] != '00-00-0000' ? $data['mmr2'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['ipvdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>IPV</b> <br>(Inactivated Polio Vaccine)</th>
                  <?php
                  $ipvCount = ($data['ipvdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $ipvCount; ?></td>
                  <td colspan="3"><?= $data['ipvdate']; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['pcv1'] != '00-00-0000' || $data['pcv2'] != '00-00-0000' || $data['pcv3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>PCV</b> <br>(Pneumococcal Conjugate Vaccine)</th>
                  <?php
                  $pcvCount = ($data['pcv1'] != '00-00-0000' ? 1 : 0) +
                      ($data['pcv2'] != '00-00-0000' ? 1 : 0) +
                      ($data['pcv3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $pcvCount; ?></td>
                  <td><?= $data['pcv1'] != '00-00-0000' ? $data['pcv1'] : ''; ?></td>
                  <td><?= $data['pcv2'] != '00-00-0000' ? $data['pcv2'] : ''; ?></td>
                  <td><?= $data['pcv3'] != '00-00-0000' ? $data['pcv3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['opv1'] != '00-00-0000' || $data['opv2'] != '00-00-0000' || $data['opv3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>OPV</b> <br>(Oral Polio Vaccine)</th>
                  <?php
                  $opvCount = ($data['opv1'] != '00-00-0000' ? 1 : 0) +
                      ($data['opv2'] != '00-00-0000' ? 1 : 0) +
                      ($data['opv3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $opvCount; ?></td>
                  <td><?= $data['opv1'] != '00-00-0000' ? $data['opv1'] : ''; ?></td>
                  <td><?= $data['opv2'] != '00-00-0000' ? $data['opv2'] : ''; ?></td>
                  <td><?= $data['opv3'] != '00-00-0000' ? $data['opv3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['dpt_hib_hepb1'] != '00-00-0000' || $data['dpt_hib_hepb2'] != '00-00-0000' || $data['dpt_hib_hepb3'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>DPT-HIB-HepB</b> <br>(Pentavalent vaccine)</th>
                  <?php
                  $dptCount = ($data['dpt_hib_hepb1'] != '00-00-0000' ? 1 : 0) +
                      ($data['dpt_hib_hepb2'] != '00-00-0000' ? 1 : 0) +
                      ($data['dpt_hib_hepb3'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $dptCount; ?></td>
                  <td><?= $data['dpt_hib_hepb1'] != '00-00-0000' ? $data['dpt_hib_hepb1'] : ''; ?></td>
                  <td><?= $data['dpt_hib_hepb2'] != '00-00-0000' ? $data['dpt_hib_hepb2'] : ''; ?></td>
                  <td><?= $data['dpt_hib_hepb3'] != '00-00-0000' ? $data['dpt_hib_hepb3'] : ''; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['hepabdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>Hepa B-BD</b> <br>(Hepatitis B)</th>
                  <?php
                  $hepabCount = ($data['hepabdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $hepabCount; ?></td>
                  <td colspan="3"><?= $data['hepabdate']; ?></td>
              </tr>
          <?php } ?>

          <?php if ($data['bcgdate'] != '00-00-0000') { ?>
              <tr>
                  <th scope="row" class="font-weight-normal"><b>BCG</b> <br>(Bacillus Calmette-Guérin)</th>
                  <?php
                  $bcgCount = ($data['bcgdate'] != '00-00-0000' ? 1 : 0);
                  ?>
                  <td><?= $bcgCount; ?></td>
                  <td colspan="3"><?= $data['bcgdate']; ?></td>
              </tr>
          <?php } ?>

            <?php } ?>
        </tbody>
    </table>
    <br>
<?php } ?>
         


</div>

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


          <script src="script.js"></script>

          <!-- DataTables -->
          <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
          <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

          <!-- page script -->
  <script>
     
  $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            </script>
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

<?php    } ?>

  <?php } ?>
</body>

</html>