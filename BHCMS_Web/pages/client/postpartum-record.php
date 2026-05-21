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
      <style type="text/css">
      
        h6 {
          font-size: 1.1em;
        }
          #example td {
            vertical-align: middle;
          }
          #example1 td {
            vertical-align: middle;
          }

        td {
          border: 1px solid #ccc;
          padding: 10px;
          position: relative;
          /* Important for absolute positioning */
        }

      .highlight:hover {
        background-color: #ffc107;
      }

      .tooltips-trigger {
        text-decoration: underline;
        cursor: pointer;
      }

      .tooltips {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 0;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
        /* Ensure tooltips appears on top of other content */
      }

      .tooltips form {
        margin: 0;
      }

      .tooltips form label,
      .tooltips form textarea {
        display: block;
        margin-bottom: 10px;
        width: 200px;
        /* Adjust the width as needed */
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


      .tooltips-trigger1 {
        text-decoration: underline;
        cursor: pointer;
      }

      .tooltips1 {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 0;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
        /* Ensure tooltips appears on top of other content */
      }

      .tooltips1 form {
        margin: 0;
      }

      .tooltips1 form label,
      .tooltips1 form textarea {
        display: block;
        margin-bottom: 10px;
        width: 200px;
        /* Adjust the width as needed */
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
                          <a href="../postpartum/postpartum.php" class="nav-link active">
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
                      <h4 class="font-weight-bold" style="font-family: Helvetica;">POSTPARTUM CARE</h4>
                    </div>
                        <div class="col-1 text-right">
                        <a href="../postpartum/postpartum.php" class="btn btn-dark btn-sm">
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
                              <div class="col-4"> 
                            </div>
                            </div>
                          </div>

                          <br>

                        <?php
                        $postpartum = mysqli_query($con, "SELECT id, postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks, remarks_24hr, remarks_1week FROM postpartum 
                    INNER JOIN client ON postpartum.patientid = client.id WHERE patientid = $id ORDER BY deliverydate DESC;"); ?>

        
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
                      
                        <table id="example" class="table table-bordered table-hover text-center">
                          <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="5" class="text-left">DETAILS</th>
                          </tr>
                            <tr>
                              <th rowspan="2">Date and Time of Delivery</th>
                              <th colspan="2">Date Postpartum Visits</th>
                              <th rowspan="2">Date and Time Initiated Brestfeeding</th>
                              <th rowspan="2"></th>
                            </tr>
                            <tr>
                              <th>Within 24 hours after delivery</th>
                              <th>Within 1 week after delivery</th>
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
                            <?php if ($data['visit24hr'] != '00-00-0000') { ?>
                            <a class="tooltips-trigger highlight" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-1" 
                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['remarks_24hr']; ?>">
                              <?php echo $data['visit24hr']; ?>
                            </a>
                          <?php } ?>
                        <div class="tooltips" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-1">
                          <?php
                          $remarks1 = $data['remarks_24hr'];
                          if ($remarks1 == NULL) { ?>
                            <form action="remarks-postpartum.php" method="post">
                              <label>Remarks</label>
                              <p>Within 24 hours after delivery:</p>
                              <textarea id="remarks" name="remarks_24hr" rows="5"></textarea>
                              <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                              <input type="submit" name="submit1" value="Enter">
                            </form>
                          <?php } else { ?>
                            <form action="remarks-postpartum.php" method="post">
                              <label>Remarks</label>
                              <p>Within 24 hours after delivery:</p>
                              <textarea id="remarks" name="remarks_24hr" rows="5"><?php echo $remarks1; ?></textarea>
                              <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                              <input type="submit" name="submit1" value="Enter">
                            </form>
                          <?php } ?>
                        </div>
                      </td>

                            <td>
                              <?php if ($data['visit1week'] != '00-00-0000') { ?>
                                  <a class="tooltips-trigger1 highlight" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-2" 
                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['remarks_1week']; ?>">
                                  <?php echo $data['visit1week']; ?></a>
                              <?php } ?>
                              <div class="tooltips1" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-2">
                                <?php
                                $remarks2 = $data['remarks_1week'];
                                if ($remarks2 == NULL) { ?>
                                  <form action="remarks-postpartum.php" method="post">
                                    <label>Remarks</label>
                                    <p>Within 1 week after delivery:</p>
                                    <textarea id="remarks" name="remarks_1week" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                  </form>
                                <?php } else { ?>
                                  <form action="remarks-postpartum.php" method="post">
                                    <label>Remarks</label>
                                    <p>Within 1 week after delivery:</p>
                                    <textarea id="remarks" name="remarks_1week"
                                      rows="5"><?php echo $data['remarks_1week']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                  </form>
                                <?php } ?>
                              </div>
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
                                        <a href="postpartum-update.php?id=<?php echo $data['postpartum_id']; ?>">
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
                        $postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks, remarks_24hr, remarks_1week FROM postpartum 
                    INNER JOIN client ON postpartum.patientid = client.id WHERE patientid = $id ORDER BY deliverydate DESC;"); ?>

                        <table id="example1" class="table table-bordered table-hover text-center">
                          <thead>            
                          <tr class="bg-light color-palette">
                              <th colspan="6" class="text-left">MICRONUTRIENT SUPPLEMENTATION</th>
                          </tr>
                            <tr>
                              <th colspan="3">Iron</th>
                              <th>Vitamin A</th>
                              <th rowspan="2">Remarks</th>
                              <th rowspan="2"></th>
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
                                          <a href="postpartum-update1.php?id=<?php echo $data['postpartum_id']; ?>">
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

                    <?php include('postpartum-addclient.php'); ?>

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
      <script src="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"></script>
      <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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

document.addEventListener("DOMContentLoaded", function () {
    const tooltipsTriggers = document.querySelectorAll(".tooltips-trigger");
    const tooltips = document.querySelectorAll(".tooltips");
    const tooltipsTriggers1 = document.querySelectorAll(".tooltips-trigger1");
    const tooltips1 = document.querySelectorAll(".tooltips1");

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
});
  </script>
      <script>
  $(function () {
                  $('[data-toggle="tooltip"]').tooltip()
              })

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
      </script>
  <?php } ?>
</body>


</html>