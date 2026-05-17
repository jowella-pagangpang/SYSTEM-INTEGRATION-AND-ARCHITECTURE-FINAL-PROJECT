<!DOCTYPE html>
<html lang="en">

<?php
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

                <title>Client Report</title>
                <link rel="icon" href="../../img/logo.png">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

 
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
                                  <a href="../main/report.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Generate Report</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="../main/client.php" class="nav-link active">
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
                                          <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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
                    <div class="row">
                      <div class="col-10">
                        <h6 class="font-weight-bold">FOR FOLLOW-UP VISIT:
                        </h6>
                      </div>
                  
    <?php if ($service == "deworming") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="dewormreport.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "immunization") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="immureport.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "nutrition1") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="nutri1report.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "nutrition2") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="nutri2report.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "sickchildren") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="sickreport.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "maternal") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="maternalreport.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>
    <?php if ($service == "postpartum") { ?>
      <div class="col-2">
        <div class="form-group">
          <a href="postpartumreport.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
            <i class="nav-icon fas fa-file-export"></i> Export Report</a>
        </div>
      </div>
    <?php } ?>

    </div>
      </div>


    <?php
    if ($service == "deworming") { ?>
      
      <?php
      $deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service INNER JOIN client ON deworming.patientid = client.id 
      WHERE service = 'Deworming 1-4 years old' AND (1stdose IS NULL OR 2nddose IS NULL)"); ?>

      <br>              
      <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING FOR 1-4 YEARS OLD
      </h5><br>

        <table id="example" class="table table-bordered text-center table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Service</th>
                          <th>Remarks</th>
                          <th>Action</th>
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
                <td>
                  <a href="../deworming1/editclient.php?did1=<?php echo $data['deworming_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br>

                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING FOR 5-9 YEARS OLD
                </h5><br>

            <?php
            $deworming2nd = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
            FROM $service WHERE service = 'Deworming 5-9 years old' AND (1stdose IS NULL OR 2nddose IS NULL)"); ?>

      <div class="card-body table-responsive p-2">
        <table id="example1" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Age</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                  <?php echo $data['age']; ?>
                </td>
                <td>
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
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
        <br><br>
      </div>

                        
      <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING FOR 10-19 YEARS OLD
      </h5><br>

     <?php
      
      $deworming3rd = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
      purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service WHERE service = 'Deworming 10-19 years old' AND (1stdose IS NULL OR 2nddose IS NULL)"); ?>


      <div class="card-body table-responsive p-2">
        <table id="example2" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Age</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
            <?php echo $data['age']; ?>
          </td>
          <td>
            <?php echo $data['purok']; ?>,
            <?php echo $data['address']; ?>
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
      <br><br><br>
      </div>
    <?php } ?>


<?php
    if ($service == "nutrition2") {
      $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      6to11mos, 12to59mos, purok, address, 
      DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
      DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
      DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2
      WHERE vitamina IS NULL OR vitamin1 IS NULL OR vitamin2 IS NULL OR iron1 IS NULL OR iron2 IS NULL OR mnp1 IS NULL
      OR mnp2 IS NULL OR deworming IS NULL"); ?>
                            
      <div class="card-body table-responsive p-2">
        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Address</th>
              <th>Age in Months</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                <td>
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
                </td>
                <td>
                  <?php
                  if ($data['6to11mos']) {
                    echo '6-11 mos.';
                  }
                  if ($data['12to59mos']) {
                    echo '12-59 mos.';
                  }
                  ?>
                </td>
                <td>
                  <?php echo $status; ?>
                </td>
                <td>
                  <?php echo $service; ?>
                </td>
                <td>
                  <?php echo nl2br($data['remarks']); ?>
                </td>
                <td>
                  <a href="../nutrition2/editclient.php?nid2=<?php echo $data['nutrition2_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } } ?>
          </tbody>
        </table>
        <br><br><br>
      </div>
    <?php } ?>

      <?php
          if ($service == "immunization") {
            $immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address,
            DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
            DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
            DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
            DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
            DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
            DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
            DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
            remarks FROM immunization WHERE bcg IS NULL OR hepab IS NULL OR dpt_hib_hepb_1stdose IS NULL OR
            dpt_hib_hepb_2nddose IS NULL OR dpt_hib_hepb_3rddose IS NULL OR opv_1stdose IS NULL OR opv_2nddose IS NULL OR
            opv_3rddose IS NULL OR pcv_1stdose IS NULL OR pcv_2nddose IS NULL OR pcv_3rddose IS NULL OR ipv IS NULL OR
            mmr1stdose IS NULL OR mmr2nddose IS NULL OR fic_date IS NULL"); ?>

      <div class="card-body table-responsive p-2">
        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
                </td>
                <td>
                  <?php if (
                    $data['bcgdate'] || $data['hepabdate'] || $data['dpt_hib_hepb1']
                    || $data['dpt_hib_hepb2'] || $data['dpt_hib_hepb3'] || $data['opv1']
                    || $data['opv2'] || $data['opv3'] || $data['pcv1']
                    || $data['pcv2'] || $data['pcv3'] || $data['ipvdate']
                    || $data['mmr1'] || $data['mmr2'] || $data['fic'] == '00-00-0000'
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
                  if ($data['fic'] == '00-00-0000') {
                    echo 'FIC<br> ';
                  }
                  ?>
                </td>
                <td>
                  <?php echo nl2br($data['remarks']); ?>
                </td>
                <td>
                  <a href="../immunization/editclient.php?iid=<?php echo $data['immunization_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br><br>
      </div>
    <?php } ?>


<?php
    if ($service == "postpartum") {
      $postpartum = mysqli_query($con, "SELECT postpartum_id, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
      DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
      DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
      DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
      DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
      DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
      DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum 
      WHERE iron_supplementation_1stdate IS NULL OR iron_supplementation_2nddate IS NULL OR iron_supplementation_3rddate
      IS NULL OR vitamin_supplementation_date IS NULL"); ?>

      <div class="card-body table-responsive p-2">
        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Delivery Date</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
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
                <td>
                  <a href="../postpartum/editclient.php?pid=<?php echo $data['postpartum_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br><br>
      </div>
    <?php } ?>


<?php
    if ($service == "nutrition1") {
      $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      purok, address, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate, 
      DATE_FORMAT(hepab1,'%m-%d-%Y') AS hepadate, DATE_FORMAT(pentavalent1st,'%m-%d-%Y') AS penta1, 
      DATE_FORMAT(pentavalent2nd,'%m-%d-%Y') AS penta2, DATE_FORMAT(pentavalent3rd, '%m-%d-%Y') AS penta3, 
      DATE_FORMAT(opv1st,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv2nd,'%m-%d-%Y') AS opv2, DATE_FORMAT(opv3rd,'%m-%d-%Y') AS opv3, 
      DATE_FORMAT(ipv,'%m-%d-%Y') AS ipv1, DATE_FORMAT(mcv1,'%m-%d-%Y') AS mcv1st, DATE_FORMAT(mcv2,'%m-%d-%Y') AS mcv2nd, DATE_FORMAT(ficdate,'%m-%d-%Y') AS fic, 
      DATE_FORMAT(breastfed1st,'%m-%d-%Y') AS breastfed1, DATE_FORMAT(breastfed2nd,'%m-%d-%Y') AS breastfed2, 
      DATE_FORMAT(breastfed3rd,'%m-%d-%Y') AS breastfed3, DATE_FORMAT(breastfed4th, '%m-%d-%Y') AS breastfed4,  
      DATE_FORMAT(breastfed5th,'%m-%d-%Y') AS breastfed5, DATE_FORMAT(breastfed6th,'%m-%d-%Y') AS breastfed6, 
      DATE_FORMAT(complementary,'%m-%d-%Y') AS comple, remarks FROM nutrition1
      WHERE bcg IS NULL OR hepab1 IS NULL OR pentavalent1st IS NULL OR pentavalent2nd IS NULL OR pentavalent3rd
      IS NULL OR opv1st IS NULL OR opv2nd IS NULL OR opv3rd IS NULL OR ipv IS NULL OR mcv1 IS NULL OR mcv2 IS NULL
      OR ficdate IS NULL"); ?>

      <div class="card-body table-responsive p-2">
        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            while ($data = mysqli_fetch_array($nutrition1)) { ?>

              <tr>
                <td>
                  <?php echo $data['fullname']; ?>
                </td>
                <td>
                  <?php echo $data['regdate']; ?>
                </td>
                <td>
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
                </td>
                <td>
                  <?php if (
                    $data['bcgdate'] || $data['hepadate'] || $data['penta1']
                    || $data['penta2'] || $data['penta3'] || $data['opv1']
                    || $data['opv2'] || $data['opv3'] || $data['ipv']
                    || $data['mcv1st'] || $data['mcv2nd'] || $data['fic'] == '00-00-0000'
                  ) {
                    echo '<span class="badge badge-warning">Follow-up</span>';
                  } ?>
                </td>
                <td>
                  <?php if ($data['bcgdate'] == '00-00-0000') {
                    echo 'BCG<br>  ';
                  }
                  if ($data['hepadate'] == '00-00-0000') {
                    echo 'Hepa B1<br>  ';
                  }
                  if ($data['penta1'] == '00-00-0000') {
                    echo 'Pentavalent 1st dose<br> ';
                  }
                  if ($data['penta2'] == '00-00-0000') {
                    echo 'Pentavalent 2nd dose<br> ';
                  }
                  if ($data['penta3'] == '00-00-0000') {
                    echo 'Pentavalent 3rd dose<br> ';
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
                  if ($data['ipv1'] == '00-00-0000') {
                    echo 'IPV<br> ';
                  }
                  if ($data['mcv1st'] == '00-00-0000') {
                    echo 'MCV1 (AMV)<br> ';
                  }
                  if ($data['mcv2nd'] == '00-00-0000') {
                    echo 'MCV2 (MMR)<br> ';
                  }
                  if ($data['fic'] == '00-00-0000') {
                    echo 'FIC<br> ';
                  }
                  ?>
                </td>
                <td>
                  <?php echo nl2br($data['remarks']); ?>
                </td>
                <td>
                  <a href="../nutrition1/editclient.php?nid1=<?php echo $data['nutrition1_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br><br>
      </div>
    <?php } ?>


  <?php
      if ($service == "sickchildren") {
        $sickchildren = mysqli_query($con, "SELECT sick_children_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
        CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
        purok, address, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
        DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
        DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
        pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, 
        remarks FROM sickchildren WHERE vitamin_supplementation_date IS NULL OR diarrhea_ors_date IS NULL OR
        diarrhea_oralzinc_date IS NULL OR pneumonia_treatment_date IS NULL"); ?>

      <div class="card-body table-responsive p-2">
        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
                </td>
                <td>
                  <?php if ($data['vitamindate'] || $data['orsdate'] || $data['oralzincdate'] || 
                    $data['pneumoniadate'] == '00-00-0000') {
                    echo '<span class="badge badge-warning">Follow-up</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php if ($data['vitamindate'] == '00-00-0000') {
                    echo 'Vitamin A Supplementation<br>  ';
                  }
                  
                  if ($data['orsdate'] == '00-00-0000') {
                    echo 'Diarrhea Treatment: ORS<br>  ';
                  }
                  
                  if ($data['oralzincdate'] == '00-00-0000') {
                    echo 'Diarrhea Treatment: Oral zinc drops or syrup<br>  ';
                  }
                  
                  if ($data['pneumoniadate'] == '00-00-0000') {
                    echo 'Pneumonia Antibiotic Treatment';
                  }
                  ?>
                </td>
                <td>
                  <?php echo nl2br($data['remarks']); ?>
                </td>
                <td>
                  <a href="../sickchildren/editclient.php?sid=<?php echo $data['sick_children_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br><br>
      </div>
    <?php } ?>


<?php
    if ($service == "maternal") {
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
      DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, remarks FROM maternal
      WHERE trimester1 IS NULL OR trimester1a IS NULL OR trimester2 IS NULL OR trimester2a IS NULL
      OR trimester3 IS NULL OR trimester3a IS NULL OR tt1date IS NULL OR tt2date IS NULL OR
      tt3date IS NULL OR tt4date IS NULL OR tt5date IS NULL OR iron1date IS NULL OR iron2date IS NULL OR iron3date IS NULL
      OR iron4date IS NULL OR iron5date IS NULL OR iron6date IS NULL"); ?>

        <table id="example" class="table text-center table-hover display" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Registration Date</th>
              <th>Address</th>
              <th>Status</th>
              <th>Service</th>
              <th>Remarks</th>
              <th>Action</th>
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
                  <?php echo $data['purok']; ?>,
                  <?php echo $data['address']; ?>
                </td>
                <td>
                  <?php if (
                    $data['tri1'] || $data['tri1a'] || $data['tri2']
                    || $data['tri2a'] || $data['tri3'] || $data['tri3a'] || 
                    $data['tt1'] || $data['tt2'] || $data['tt3'] ||
                    $data['tt4'] || $data['tt5'] || $data['iron1st'] || $data['iron2nd']
                    || $data['iron3rd'] || $data['iron4th'] || $data['iron5th'] ||
                    $data['iron6th'] == '00-00-0000'
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
                  }
                  if ($data['tt1'] == '00-00-0000') {
                    echo 'TT1<br>  ';
                  }
                  if ($data['tt2'] == '00-00-0000') {
                    echo 'TT2<br>  ';
                  }
                  if ($data['tt3'] == '00-00-0000') {
                    echo 'TT3<br>  ';
                  }
                  if ($data['tt4'] == '00-00-0000') {
                    echo 'TT4<br>  ';
                  }
                  if ($data['tt5'] == '00-00-0000') {
                    echo 'TT5<br>  ';
                  }
                  if ($data['iron1st'] == '00-00-0000' || $data['iron2nd'] == '00-00-0000' || 
                  $data['iron3rd'] == '00-00-0000' || $data['iron4th'] == '00-00-0000' || 
                  $data['iron5th'] == '00-00-0000' || $data['iron6th'] == '00-00-0000') {
                    echo 'Iron Supplementation<br>  ';
                  } ?>
                </td>
                <td>
                  <?php echo nl2br($data['remarks']); ?>
                </td>
                <td>
                  <a href="../maternal/editclient.php?mid=<?php echo $data['maternal_id']; ?>">
                    <button type="button" class="btn btn-primary btn-xs">
                      <i class="nav-icon fas fa-edit"></i> Edit</button>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
        <br><br><br>
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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": false,
        "stripe": false,
        "language": {
            "emptyTable": "No follow-up visit"
        }
    });
        $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": false,
        "stripe": false,
        "language": {
            "emptyTable": "No follow-up visit"
        }
    });
        $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": false,
        "stripe": false,
        "language": {
            "emptyTable": "No follow-up visit"
        }
    });
});
</script>

  <?php } ?>

</body>

</html>