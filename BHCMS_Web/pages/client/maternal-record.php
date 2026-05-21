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
  <link rel="icon" href="../../img/basak logo.png">
    <link rel="stylesheet" href="styles.css">

    <style type="text/css">
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
        #example3 thead th,
        #example3 td {
          vertical-align: middle;
        }
        #example4 thead th,
        #example4 td {
          vertical-align: middle;
        }

      h6 {
        font-size: 1.1em;
      }

        td {
            border: 1px solid #ccc;
            padding: 10px;
            position: relative; /* Important for absolute positioning */
        }

        .highlight:hover {
          background-color: #ffc107;
        }

/*tooltips*/
        .tooltips-trigger, .tooltips-trigger1, .tooltips-trigger2, .tooltips-trigger3, .tooltips-trigger4, .tooltips-trigger5 {
            text-decoration: underline;
            cursor: pointer;
        }

        .tooltips, .tooltips1, .tooltips2, .tooltips3, .tooltips4, .tooltips5 {
            display: none;
            position: absolute;
            bottom:60px;
            left: 0;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1; /* Ensure tooltips appears on top of other content */
        }

        .tooltips form {
            margin: 0;
        }

        .tooltips form label,
        .tooltips form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips form input[type="submit"]:hover {
            background-color: #0056b3;
        }


/*tooltips1*/

        .tooltips1 form {
            margin: 0;
        }

        .tooltips1 form label,
        .tooltips1 form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips1 form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips1 form input[type="submit"]:hover {
            background-color: #0056b3;
        }


/*tooltips2*/

        .tooltips2 form {
            margin: 0;
        }

        .tooltips2 form label,
        .tooltips2 form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips2 form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips2 form input[type="submit"]:hover {
            background-color: #0056b3;
        }


/*tooltips3*/

        .tooltips3 form {
            margin: 0;
        }

        .tooltips3 form label,
        .tooltips3 form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips3 form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips3 form input[type="submit"]:hover {
            background-color: #0056b3;
        }

/*tooltips4*/

        .tooltips4 form {
            margin: 0;
        }

        .tooltips4 form label,
        .tooltips4 form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips4 form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips4 form input[type="submit"]:hover {
            background-color: #0056b3;
        }

/*tooltips5*/

        .tooltips5 form {
            margin: 0;
        }

        .tooltips5 form label,
        .tooltips5 form textarea {
            display: block;
            margin-bottom: 10px;
            width: 200px; /* Adjust the width as needed */
        }

        .tooltips5 form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tooltips5 form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .tooltip-content {
              white-space: pre-line;
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
          <div class="col-11">
            <h4 class="font-weight-bold" style="font-family: Helvetica;">MATERNAL CARE</h4>
          </div>
              <div class="col-1 text-right">
              <a href="../maternal/maternal.php" class="btn btn-dark btn-sm">
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

                      <br>


                  <?php
                  $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
                  DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, rem_tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, rem_tri1a, 
                  DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, rem_tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, rem_tri2a, 
                  DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, rem_tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, rem_tri3a 
                  FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY reg_date DESC;");
                  ?>


                      <div class="card-block">
                        <div class="row">
                          <div class="col-6">                
                          </div>
                          <div class="col-2"> </div>
                          <div class="col-2"> </div>
                          <div class="col-2"> 
                            <button type="button" class="btn btn-primary bg-gradient-primary btn-block btn-sm"
                              data-toggle="modal" data-target="#add-client"><i class="nav-icon fas fa-user-plus"></i> Add new record
                            </button>
                        </div>
                        </div>
                      </div>
                      <br>
                      <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                        width="100%">
                        <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="7" class="text-left">DETAILS</th>
                          </tr>
                          <tr>
                            <th rowspan="2">Date of Registration</th>
                            <th data-toggle="tooltip" title="Last Normal Menstrual Period/Gravida-Parity" rowspan="2">LMP <br>G-P</th>
                            <th data-toggle="tooltip" title="Expected Date of Confinement" rowspan="2">EDC</th>
                            <th colspan="3">Prenatal Visits</th>
                            <th rowspan="2"></th>
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
                              <?php if($data['lmpdate'] != '00-00-0000') {echo $data['lmpdate'];}; ?> 
                                <br><?php echo 'G' . $data['g']; ?>
                                <?php echo 'P' . $data['p']; ?>
                              </td>
                              <td>
                                <?php if($data['edcdate'] != '00-00-0000') {echo $data['edcdate'];}; ?>
                              </td>
                              <td>
                                    <?php if ($data['tri1'] != '00-00-0000') { ?>
                                              <a class="tooltips-trigger highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-1"
                                          data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri1']; ?>">
                                          <?php echo $data['tri1']; ?></a>
                                          <?php } ?>
                                          <div class="tooltips" data-tooltip-id="<?php echo $data['maternal_id']; ?>-1">
                                            <?php
                                            $remarks1 = $data['rem_tri1'];
                                            if ($remarks1 == NULL) { ?>
                                                <form action="remarks-maternal.php" method="post">
                                                  <label>Remarks</label>
                                                  <p>First Trimester:</p>
                                                  <textarea id="remarks" name="rem_tri1" rows="5"></textarea>
                                                  <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                  <input type="submit" name="submit1" value="Enter">
                                                </form>
                                            <?php } else { ?>
                                                <form action="remarks-maternal.php" method="post">
                                                  <label>Remarks</label>
                                                  <p>First Trimester:</p>
                                                  <textarea id="remarks" name="rem_tri1" rows="5"><?php echo $data['rem_tri1']; ?></textarea>
                                                  <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                  <input type="submit" name="submit1" value="Enter">
                                                </form>
                                            <?php } ?>
                                          </div>
                                        <br>
                                        <?php if ($data['tri1a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger1 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-2"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri1a']; ?>">
                                              <?php echo $data['tri1a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips1" data-tooltip-id="<?php echo $data['maternal_id']; ?>-2">
                                                <?php
                                                $remarks1a = $data['rem_tri1a'];
                                                if ($remarks1a == NULL) { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>First Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri1a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit4" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>First Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri1a" rows="5"><?php echo $data['rem_tri1a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit4" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
                                          </td>
                                          <td>
                                          <?php if ($data['tri2'] != '00-00-0000') { ?>
                                                    <a class="tooltips-trigger2 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-3"
                                                data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri2']; ?>">
                                                <?php echo $data['tri2']; ?></a>
                                                <?php } ?>
                                                <div class="tooltips2" data-tooltip-id="<?php echo $data['maternal_id']; ?>-3">
                                                  <?php
                                                  $remarks2 = $data['rem_tri2'];
                                                  if ($remarks2 == NULL) { ?>
                                                      <form action="remarks-maternal.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Second Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri2" rows="5"></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit2" value="Enter">
                                                      </form>
                                                  <?php } else { ?>
                                                      <form action="remarks-maternal.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Second Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri2" rows="5"><?php echo $data['rem_tri2']; ?></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit2" value="Enter">
                                                      </form>
                                                  <?php } ?>
                                                </div>
                                        <br> 
                                        <?php if ($data['tri2a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger3 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-4"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri2a']; ?>">
                                              <?php echo $data['tri2a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips3" data-tooltip-id="<?php echo $data['maternal_id']; ?>-4">
                                                <?php
                                                $remarks2 = $data['rem_tri2a'];
                                                if ($remarks2 == NULL) { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Second Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri2a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit5" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Second Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri2a" rows="5"><?php echo $data['rem_tri2a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit5" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
                                          </td>
                                          <td>
                                          <?php if ($data['tri3'] != '00-00-0000') { ?>
                                                    <a class="tooltips-trigger4 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-5"
                                                data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri3']; ?>">
                                                <?php echo $data['tri3']; ?></a>
                                                <?php } ?>
                                                <div class="tooltips4" data-tooltip-id="<?php echo $data['maternal_id']; ?>-5">
                                                  <?php
                                                  $remarks1a = $data['rem_tri3'];
                                                  if ($remarks1a == NULL) { ?>
                                                      <form action="remarks-maternal.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Third Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri3" rows="5"></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit3" value="Enter">
                                                      </form>
                                                  <?php } else { ?>
                                                      <form action="remarks-maternal.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Third Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri3" rows="5"><?php echo $data['rem_tri3']; ?></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit3" value="Enter">
                                                      </form>
                                                  <?php } ?>
                                                </div>
                                        <br>
                                        <?php if ($data['tri3a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger5 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-6"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri3a']; ?>">
                                              <?php echo $data['tri3a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips5" data-tooltip-id="<?php echo $data['maternal_id']; ?>-6">
                                                <?php
                                                $remarks1a = $data['rem_tri3a'];
                                                if ($remarks1a == NULL) { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Third Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri3a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit6" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks-maternal.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Third Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri3a" rows="5"><?php echo $data['rem_tri3a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit6" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
                                          </td>
                                <td>
                                    <a href="maternal-update1.php?id=<?php echo $data['maternal_id']; ?>">
                                    <button type="button" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Update Record">
                                        <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    </a>
                                  </td>
                            </tr>

                          <?php } ?>

                        </tbody>
                      </table>
                      <br>


                    <?php
                    $maternal = mysqli_query($con, "SELECT maternal_id, patientid, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
                  DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
                  DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
                  DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
                  DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber
                  FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY tt1date DESC;");
                    ?>

                      <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="7" class="text-left">TETANUS TOXOID VACCINE</th>
            </tr>
                          <tr>
                            <th rowspan="2">Tetanus Status</th>
                            <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
                            <th rowspan="2"></th>
                          </tr>
                          <tr>
                            <th>TT1</th>
                            <th>TT2</th>
                            <th>TT3</th>
                            <th>TT4</th>
                            <th>TT5</th>
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
                                <?php if($data['tt1'] != '00-00-0000') {echo $data['tt1'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt2'] != '00-00-0000') {echo $data['tt2'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt3'] != '00-00-0000') {echo $data['tt3'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt4'] != '00-00-0000') {echo $data['tt4'];}; ?>
                              </td>
                              <td>
                                <?php if($data['tt5'] != '00-00-0000') {echo $data['tt5'];}; ?>
                              </td>
                                <td>
                                    <a href="maternal-update2.php?id=<?php echo $data['maternal_id']; ?>">
                                    <button type="button" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Update Record">
                                        <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    </a>
                                  </td>
                                </tr>

                          <?php } ?>

                        </tbody>
                      </table>
                    <br>
                      
                    <?php
                    $maternal = mysqli_query($con, "SELECT maternal_id, patientid, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
                  DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
                  DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
                  DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
                  DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber
                  FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY tt1 DESC;");
                    ?>

                      <table id="example2" class="table table-bordered table-hover text-center">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="7" class="text-left">MICRONUTRIENT SUPPLEMENTATION</th>
            </tr>
                          <tr>
                            <th colspan="6">Date and Number Iron with Folic Acid was given</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          while ($data = mysqli_fetch_array($maternal)) { ?>

                            <tr>
                              <td>
                                <?php if($data['iron1st'] != '00-00-0000') {echo $data['iron1st'];}; ?><br>
                                <?php if($data['1datenumber']>0) {echo $data['1datenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron2nd'] != '00-00-0000') {echo $data['iron2nd'];}; ?><br>
                                <?php if($data['2datenumber']>0) {echo $data['2datenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron3rd'] != '00-00-0000') {echo $data['iron3rd'];}; ?><br>
                                <?php if($data['3datenumber']>0) {echo $data['3datenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron4th'] != '00-00-0000') {echo $data['iron4th'];}; ?><br>
                                <?php if($data['4datenumber']>0) {echo $data['4datenumber'];}; ?>
                              </td>
                              <td>
                                <?php if($data['iron5th'] != '00-00-0000') {echo $data['iron5th'];}; ?><br>
                                <?php if($data['5datenumber']>0) {echo $data['5datenumber'];}; ?>
                                </td>
                                <td>
                                <?php if($data['iron6th'] != '00-00-0000') {echo $data['iron6th'];}; ?><br>
                                <?php if($data['6datenumber']>0) {echo $data['6datenumber'];}; ?>
                                </td>
                                <td>
                                    <a href="maternal-update3.php?id=<?php echo $data['maternal_id']; ?>">
                                    <button type="button" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Update Record">
                                        <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    </a>
                                  </td>
                                </tr>

                          <?php } ?>

                        </tbody>
                      </table>
                    <br>

                    <?php
                    $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
                  syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
                  DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, remarks 
                  FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY sy_date DESC;");
                    ?>

                      <table id="example3" class="table table-bordered table-hover text-center" width="100%">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="4" class="text-left">STI SURVEILLANCE</th>
            </tr>
                          <tr>
                            <th>Tested for SY</th>
                            <th>Result for SY Testing</th>
                            <th>Given Penicillin</th>
                            <th rowspan="2"></th>
                          </tr>
                          <tr>
                            <th>Date</th>
                            <th>(+/-) <br>Date</th>
                            <th>Y/N <br>Date</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          while ($data = mysqli_fetch_array($maternal)) { ?>

                            <tr>
                              <td>
                                <?php if($data['sy_date'] != '00-00-0000') {echo $data['sy_date'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['syresult']; ?> <br>
                                <?php if($data['result_date'] != '00-00-0000') {echo $data['result_date'];}; ?>
                              </td>
                              <td>
                                <?php echo $data['given_penicillin']; ?> <br>
                                <?php if($data['penicillin_date'] != '00-00-0000') {echo $data['penicillin_date'];}; ?>
                              </td>
                                <td>
                                    <a href="maternal-update4.php?id=<?php echo $data['maternal_id']; ?>">
                                    <button type="button" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Update Record">
                                        <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    </a>
                                  </td>
                            </tr>

                          <?php } ?>

                        </tbody>
                      </table>
                      <br>


                      <?php
                    $maternal = mysqli_query($con, "SELECT maternal_id, patientid, 
                    DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
                    outcome, gender, birth_weight, facility, nid, attended, remarks 
                    FROM maternal INNER JOIN client ON maternal.patientid = client.id WHERE patientid = $id ORDER BY terminated_date DESC;");
                    ?>

                      <table id="example4" class="table table-bordered table-hover text-center" width="100%">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="8" class="text-left">PREGNANCY AND LIVEBIRTHS</th>
            </tr>
                          <tr>
                            <th colspan="2">Pregnancy</th>
                            <th colspan="4">Livebirths</th>
                            <th rowspan="3">Remarks</th>
                            <th rowspan="3"></th>
                          </tr>
                          <tr>
                            <th rowspan="2">Date Terminated</th>
                            <th rowspan="2">Outcome / <br>Gender (M/F)</th>
                            <th rowspan="2" class="font-weight-normal"><b>Birth Weight</b> <br>(grams)</th>
                            <th colspan="2">Place of</th>
                            <th rowspan="2">Attended by</th>
                          </tr>
                          <tr>
                            <th>Health Facility</th>
                            <th>NID</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          while ($data = mysqli_fetch_array($maternal)) { ?>

                            <tr>
                              <td>
                                <?php if($data['terminated_date'] != '00-00-0000') {echo $data['terminated_date'];}; ?>
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
                                <?php echo nl2br($data['remarks']); ?>
                              </td>
                              <td>
                                  <a href="maternal-update5.php?id=<?php echo $data['maternal_id']; ?>">
                                  <button type="button" class="btn btn-success btn-sm"
                                  data-toggle="tooltip" data-placement="top" title="Update Record">
                                      <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                  </button>
                                  </a>
                                </td>
                            </tr>

                          <?php } ?>

                        </tbody>
                      </table>
                <br><br>
                    </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <?php include('maternal-addclient.php'); ?>
        
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
  $(document).ready(function() {
    $('.tooltips-trigger').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger1').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger2').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger3').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger4').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger5').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

document.addEventListener("DOMContentLoaded", function () {
    const tooltipsTriggers = document.querySelectorAll(".tooltips-trigger");
    const tooltips = document.querySelectorAll(".tooltips");
    const tooltipsTriggers1 = document.querySelectorAll(".tooltips-trigger1");
    const tooltips1 = document.querySelectorAll(".tooltips1");
    const tooltipsTriggers2 = document.querySelectorAll(".tooltips-trigger2");
    const tooltips2 = document.querySelectorAll(".tooltips2");
    const tooltipsTriggers3 = document.querySelectorAll(".tooltips-trigger3");
    const tooltips3 = document.querySelectorAll(".tooltips3");
    const tooltipsTriggers4 = document.querySelectorAll(".tooltips-trigger4");
    const tooltips4 = document.querySelectorAll(".tooltips4");
    const tooltipsTriggers5 = document.querySelectorAll(".tooltips-trigger5");
    const tooltips5 = document.querySelectorAll(".tooltips5");


    tooltipsTriggers.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });


    tooltipsTriggers1.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips1[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips1[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });


    tooltipsTriggers2.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips2[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips2[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });

    tooltipsTriggers3.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips3[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips3[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });


    tooltipsTriggers4.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips4[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips4[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });


    tooltipsTriggers5.forEach((trigger) => {
        trigger.addEventListener("click", function (event) {
            event.preventDefault();
            const tooltipId = trigger.getAttribute("data-tooltip-id");
            const tooltip = document.querySelector(`.tooltips5[data-tooltip-id="${tooltipId}"]`);
            if (tooltip) {
                tooltip.style.display = "block";
            }
        });

        // Close the tooltips if clicked outside
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target)) {
                const tooltipId = trigger.getAttribute("data-tooltip-id");
                const tooltip = document.querySelector(`.tooltips5[data-tooltip-id="${tooltipId}"]`);
                if (tooltip && !tooltip.contains(event.target)) {
                    tooltip.style.display = "none";
                }
            }
        });
    });
});

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

    $('[data-toggle="tooltip"]').tooltip();
    });

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
    
    $(function () {
      $('#example4').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    }); 
  </script>

  <?php } ?>

</body>

</html>