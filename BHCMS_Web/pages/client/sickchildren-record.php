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

      <style>
        h6 {
          font-size: 1.1em;
        }
          #example td {
            vertical-align: middle;
          }
          #example1 td {
            vertical-align: middle;
          }
          #example2 td {
            vertical-align: middle;
          }
          #example4 td {
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
                                    <a href="../sickchildren/sickchildren.php" class="nav-link active">
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
                    <h4 class="font-weight-bold" style="font-family: Helvetica;">SICK CHILDREN</h4>
                  </div>
                      <div class="col-1 text-right">
                      <a href="../sickchildren/sickchildren.php" class="btn btn-dark btn-sm">
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

                          <br>
                          
                       <?php
                       $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status FROM sickchildren
                INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id;"); ?>
                    

    <div class="card-block">
    <div class="row">
      <div class="col-6">                
      </div>
      <div class="col-2"> </div>
      <div class="col-2"> </div>
      <div class="col-2"> 
        <button type="button" class="btn btn-primary bg-gradient-primary btn-block btn-sm"
          data-toggle="modal" data-target="#add-client"><i class="nav-icon fas fa-user-plus"></i> Add new record</button>
    </div>
    </div>
    </div>
    <br>
                            <table id="example" class="table table-bordered table-hover text-center">
                              <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="2" class="text-left">DETAILS</th>
                          </tr>
                              <th>Date of Registration</th>
                              <th class="font-weight-normal"><b>SE Status</b>
                                <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                              </th> 
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
                                        <?php echo $data['se_status']; ?>
                                      </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>


                          <br>


                          <?php
                          $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
                DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks1 FROM sickchildren
                INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id;");
                          ?>

                            <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                              <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="6" class="text-left">VITAMIN A SUPPLEMENTATION</th>
                          </tr>
                                <tr>
                                  <th>6-11 mos.</th>
                                  <th>12-59 mos.</th>
                                  <th>Diagnosis/ <br>Findings</th>
                                  <th>Date Given</th>
                                  <th>Remarks</th>
                                  <th></th>
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
                                        <?php if ($data['vitamindate'] != '00-00-0000') {
                                          echo $data['vitamindate'];
                                        }
                                        ; ?>
                                      </td>
                                    <td>
                                      <?php echo nl2br($data['remarks1']); ?>
                                    </td>
                    <td>
                        <a href="sickchildren-update1.php?id=<?php echo $data['sick_children_id']; ?>">
                        <button type="button" class="btn btn-success btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Update Record">
                            <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                        </button>
                        </a>
                        </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
                            <br>

                        
                          <?php
                          $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, diarrhea_age, 
                      DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
                      remarks2 FROM sickchildren INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id;");
                          ?>

                            <table id="example2" class="table table-bordered table-hover text-center" width="100%">
                              <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="5" class="text-left">DIARRHEA CASES SEEN AND GIVEN TREATMENT</th>
                          </tr>
                                <tr>
                                  <th rowspan="2">Age in Months</th>
                                  <th colspan="2">Date Given</th>
                                  <th rowspan="2">Remarks</th>
                                  <th rowspan="2"></th>
                                </tr>
                                <tr>
                                  <th>ORS</th>
                                  <th>Oral zinc drops or syrup</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                    <tr>
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
                                      <?php echo nl2br($data['remarks2']); ?>
                                    </td>
                    <td>
                        <a href="sickchildren-update2.php?id=<?php echo $data['sick_children_id']; ?>">
                        <button type="button" class="btn btn-success btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Update Record">
                            <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                        </button>
                        </a>
                        </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
                            <br>

                        
                          <?php
                          $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, 
                      pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks FROM sickchildren
                      INNER JOIN client ON sickchildren.patientid = client.id WHERE patientid = $id;");
                          ?>


                            <table id="example3" class="table table-bordered table-hover text-center">
                              <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="4" class="text-left">PNEUMONIA CASES SEEN AND GIVEN TREATMENT</th>
                          </tr>
                          <tr>
                                  <th>Age in Months</th>
                                  <th>Date Given Treatment</th>
                                  <th>Remarks</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                    <tr>
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
                        <a href="sickchildren-update3.php?id=<?php echo $data['sick_children_id']; ?>">
                        <button type="button" class="btn btn-success btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Update Record">
                            <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                        </button>
                        </a>
                        </td>
                                    </tr>

                                    <?php
                                } ?>
                              </tbody>
                            </table>
                    <br>

                    <?php
                    $consult = mysqli_query($con, "SELECT consultation.consult_id, consultation.patientid, 
              DATE_FORMAT(consultation.date,'%m-%d-%Y') AS consultdate, consultation.weight, consultation.height, consultation.diagnosis, 
              consultation.treatment, consultation.remarks
              FROM consultation
              INNER JOIN client ON consultation.patientid = client.id WHERE consultation.patientid = $id ORDER BY consultdate DESC;");
                    ?>

<div class="card-block">
    <div class="row">
      <div class="col-6">                
      </div>
      <div class="col-2"> </div>
      <div class="col-2"> </div>
      <div class="col-2">  

        <?php
          if (mysqli_num_rows($sickchildren) > 0) {
        ?>
      <a href="../sickchildren/add-consultation.php?sid=<?php echo $row['id']; ?>">
        <button type="button" class="btn btn-primary btn-sm btn-block">
            <i class="nav-icon fas fa-stethoscope" aria-hidden="true"></i> Add consultation
        </button>
        </a>
      <?php } ?>

    </div>
    </div>
    </div>
    <br>

                            <table id="example4" class="table table-bordered table-hover text-center" width="100%">
                              <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="8" class="text-left">CONSULTATION INFORMATION</th>
                          </tr>
                                <tr>
                                  <th>Date</th>
                                  <th class="font-weight-normal"><b>Weight</b> (kg)</th>
                                  <th class="font-weight-normal"><b>Height</b> (cm)</th>
                                  <th>Diagnosis</th>
                                  <th>Treatment</th>
                                  <th>Remarks</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                while ($data = mysqli_fetch_array($consult)) { 
                                  if ($years < 20) { ?>

                                    <tr>
                                      <td>
                                        <?php if ($data['consultdate'] != '00-00-0000') {
                                          echo $data['consultdate'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['weight'] != '0') {
                                          echo $data['weight'] . ' kg';
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['height'] != '0') {
                                          echo $data['height'] . ' cm';
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['diagnosis']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['treatment']; ?>
                                      </td>
                                    <td>
                                      <?php echo nl2br($data['remarks']); ?>
                                    </td>
                    <td>
                        <a href="update-consult.php?id=<?php echo $data['consult_id']; ?>">
                        <button type="button" class="btn btn-success btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Update Record">
                            <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                        </button>
                        </a>
                        </td>
                                    </tr>

                                    <?php
                                  }
                                } ?>
                              </tbody>
                            </table>
                            <br><br>

                        </div>

                  </form>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <?php include('sickchildren-addclient.php'); ?>

              </div>
          </div>
          </section>
          </div>
    </div>
    <!-- ./wrapper -->

      <?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
  } ?>


    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- page script -->
  <script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
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

      </script>
  <?php } ?>
</body>

</html>