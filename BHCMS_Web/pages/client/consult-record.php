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

            h6 {
              font-size: 1.1em;
            }

             #example td {
              vertical-align: middle;
            }
            td {
                border: 1px solid #ccc;
                padding: 10px;
                position: relative; /* Important for absolute positioning */
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


            .tooltips-trigger1 {
                text-decoration: underline;
                cursor: pointer;
            }

            .tooltips1 {
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
                                <a href="../client/general-consult.php" class="nav-link active">
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
                        <h4 class="font-weight-bold" style="font-family: Helvetica;">GENERAL CONSULTATION</h4>
                      </div>
                        <div class="col-1 text-right">
                            <a href="../client/general-consult.php" class="btn btn-dark btn-sm">
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

                    $consult = mysqli_query($con, "SELECT id, consult_id, patientid, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, DATE_FORMAT(date,'%m-%d-%Y') AS consultdate, weight, height, diagnosis, treatment, remarks FROM consultation INNER JOIN client ON consultation.patientid = client.id WHERE patientid = $id ORDER BY consultdate DESC;");
                            ?>

        
        <div class="card-block">
                        <div class="row">
                          <div class="col-6">                
                          </div>
                          <div class="col-2"> </div>
                          <div class="col-2"> </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-primary bg-gradient-primary btn-block btn-sm"
                              data-toggle="modal" data-target="#add-consult"><i class="nav-icon fas fa-user-plus"></i> Add consultation
                            </button>
                        </div>
                        </div>
                      </div>
                      <br>

          <table id="example" class="table table-bordered table-hover text-center">
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

          <?php while ($data = mysqli_fetch_array($consult)) { ?>

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
                  <a href="update-genconsult.php?id=<?php echo $data['consult_id']; ?>">
                  <button type="button" class="btn btn-success btn-sm"
                  data-toggle="tooltip" data-placement="top" title="Update Record">
                      <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                  </button>
                  </a>
                  </td>
            </tr>

        </tbody>

        <?php
          } ?>

        </table>
                          <br><br>
                    </div>

                      </form>


        </div>
        <!-- /.card-body -->



        </div>
        <!-- /.card -->

        <?php include('add-general-consult.php'); ?>

        </div>
        </div>
        </section>
        </div>
        </div>
        <!-- ./wrapper -->

            <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php");
    } ?>

          <script src="script.js"></script>

          <!-- DataTables -->
          <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
          <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
          <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

          <!-- page script -->
  <script>
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

  <?php } ?>
</body>

</html>