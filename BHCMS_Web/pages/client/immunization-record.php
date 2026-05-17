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

      #example2 td,
      #example2 th {
        vertical-align: middle;
      }

      #example3 td {
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
                <div class="col-11">
                  <h4 class="font-weight-bold" style="font-family: Helvetica;">IMMUNIZATION AND
                    NUTRITION SERVICES FOR 0-12 MONTHS OLD</h4>
                </div>
                <div class="col-1 text-right">
                  <a href="../immunization/immunization.php" class="btn btn-dark btn-sm">
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
                      $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2 FROM immunization 
INNER JOIN client ON immunization.patientid = client.id WHERE patientid = $id;");
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
                      <table id="example" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="4" class="text-left">DETAILS</th>
            </tr>
                          <tr>
                            <th rowspan="2">Date of Registration</th>
                            <th rowspan="2" class="font-weight-normal"><b>SE Status</b>
                              <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                            </th>
                            <th colspan="2">Child Protected at Birth (CPAB)</th>
                          </tr>
                          <tr>
                            <th class="font-weight-normal">TT2/Td2 given <br>to the mother</th>
                            <th class="font-weight-normal">TT3/Td3 to TT5/Td5 <br>(or TT1/Td1 to TT5/Td5)<br>
                              given to the mother
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
                                <?php echo $data['se_status']; ?>
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
                      <br>


                      <?php
                      $immunization = mysqli_query($con, "SELECT immunization_id, patientid, length, weight, birth_weight_status, 
                  DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed 
                  FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE patientid = $id;");
                      ?>

                      <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="5" class="text-left">NEWBORN</th>
            </tr>
                          <tr>
                            <th rowspan="2" class="font-weight-normal"><b>Length at birth</b> <br>(cm)</th>
                            <th rowspan="2" class="font-weight-normal"><b>Weight at birth</b> <br>(kg)</th>
                            <th>Status <br>(Birth Weight)</th>
                            <th rowspan="2">Initiated breast feeding <br>immediately after birth <br>lasting for 90
                              minutes</th>
                            <th rowspan="2"></th>
                          </tr>
                          <tr>
                            <th class="font-weight-normal"><b>L:</b> low:
                              <2,500 gms <br><b>N:</b> normal: >2,500 gms <br><b>U:</b> unknown
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($data = mysqli_fetch_array($immunization)) { ?>

                            <tr>
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
                                <a href="immunization-update1.php?id=<?php echo $data['immunization_id']; ?>"
                                data-toggle="tooltip" data-placement="top" title="Update Record">
                                  <button type="button" class="btn btn-success btn-sm">
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
                      $immunization = mysqli_query($con, "SELECT id, immunization_id, patientid, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
                      DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
                  DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
                  DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
                  DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
                  DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
                  DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic, remarks, remarks1,
                  remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE patientid = $id;");
                      ?>


                      <div class="card-block">
                        <div class="row">
                          <div class="col-6">
                          </div>
                          <div class="col-2"> </div>
                          <div class="col-2"> </div>
                          <div class="col-2">
                            <?php
                              if (mysqli_num_rows($immunization) > 0) {
                            ?>
                            <a href="immunization-update2.php?id=<?php echo $row['id']; ?>">
                              <button type="button" class="btn btn-primary btn-sm btn-block">
                                <i class="nav-icon fas fa-syringe" aria-hidden="true"></i> Add immunization
                              </button>
                            </a>
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <br>


                      <table id="example2" class="table table-bordered table-hover text-center" width="100%">
                        <col>
                        <colgroup span="2"></colgroup>
                        <colgroup span="2"></colgroup>
                        <thead>            
            <tr class="bg-light color-palette">
                <th colspan="6" class="text-left">IMMUNIZATION</th>
            </tr>
                          <tr>
                            <th rowspan="2">Vaccine</td>
                            <th scope="colgroup">Doses</th>
                            <th colspan="3" scope="colgroup">Date immunization Received</th>
                            <th scope="colgroup">Remarks</th>
                          </tr>
                        </thead>
                        </tbody>
                        <?php
                        // Check if there are rows in the result set
                        if (mysqli_num_rows($immunization) > 0) {
                          ?>
                          <tbody>
                            <?php
                            while ($data = mysqli_fetch_array($immunization)) { ?>

                              <tr>
                                <th scope="row" class="font-weight-normal"><b>BCG</b> <br>(Bacillus Calmette-Guérin)</th>
                                <td><b>1</b> <br>(newborn)</td>
                                <td colspan="3">
                                  <?php if ($data['bcgdate'] != '00-00-0000') {
                                    echo $data['bcgdate'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>Hepa B-BD</b> <br>(Hepatitis B)</th>
                                <td><b>1</b> <br>(newborn)</td>
                                <td colspan="3">
                                  <?php if ($data['hepabdate'] != '00-00-0000') {
                                    echo $data['hepabdate'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks1']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>DPT-HIB-HepB</b> <br>(Pentavalent vaccine)</th>
                                <td><b>3</b> <br>(1 ½, 2 ½, 3 ½ mos)</td>
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
                                  <?php echo nl2br($data['remarks2']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>OPV</b> <br>(Oral Polio Vaccine)</th>
                                
                                <td><b>3</b> <br>(1 ½, 2 ½, 3 ½ mos)</td>
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
                                  <?php echo nl2br($data['remarks3']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>PCV</b> <br>(Pneumococcal Conjugate Vaccine)</th>
                                <td><b>3</b> <br>(1 ½, 2 ½, 3 ½ mos)</td>
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
                                  <?php echo nl2br($data['remarks4']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>IPV</b> <br>(Inactivated Polio Vaccine)</th>
                                <td><b>1</b> <br>(3 ½ mos)</td>
                                <td colspan="3">
                                  <?php if ($data['ipvdate'] != '00-00-0000') {
                                    echo $data['ipvdate'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks5']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>MMR</b> <br>(Measles, mumps, and rubella)</th>
                                <td><b>2</b> <br>(9 & 12 mos)</td>
                                <td>
                                  <?php if ($data['mmr1'] != '00-00-0000') {
                                    echo $data['mmr1'];
                                  }
                                  ; ?>
                                </td>
                                <td colspan="2">
                                  <?php if ($data['mmr2'] != '00-00-0000') {
                                    echo $data['mmr2'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks6']); ?>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row" class="font-weight-normal"><b>FIC</b> <br>(Fully Immunized Child)</th>
                                <td></td>
                                <td colspan="3">
                                  <?php if ($data['fic'] != '00-00-0000') {
                                    echo $data['fic'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks7']); ?>
                                </td>
                              </tr>
                            <?php } ?>
                          <?php } else { ?>
                            <!-- Add a row for custom message when no data is available -->
                            <tr>
                              <td colspan="6" class="dataTables_empty">No data available in table</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <br>



                      <br><br>
                    </div>

                  </form>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <?php include('immunization-addclient.php'); ?>
            </div>
        </div>
        </section>
      </div>

      </div>
      <!-- ./wrapper -->

    <?php } elseif ($_SESSION['type'] == "Nurse") {
        header("Location: ../../index.php");
      } ?>


    <script src="path/to/jquery.js"></script>
    <script src="path/to/bootstrap.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


    <!-- page script -->
    <script>
    $(document).ready(function(){
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

    </script>


  <?php } ?>
</body>

</html>