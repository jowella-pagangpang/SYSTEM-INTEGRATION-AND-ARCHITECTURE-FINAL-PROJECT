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

    <title>Deworming 1-4 years old</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="styles.css">

    <style type="text/css">


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

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const tooltipsTrigger = document.querySelector(".tooltips-trigger");
    const tooltips = document.querySelector(".tooltips");

    tooltipsTrigger.addEventListener("click", function (event) {
        event.preventDefault();
        tooltips.style.display = "block";
    });

    // Close the tooltips if clicked outside
    document.addEventListener("click", function (event) {
        if (!tooltips.contains(event.target) && event.target !== tooltipsTrigger) {
            tooltips.style.display = "none";
        }
    });
});

    document.addEventListener("DOMContentLoaded", function () {
    const tooltipsTrigger1 = document.querySelector(".tooltips-trigger1"); // Use tooltipsTrigger1
    const tooltips1 = document.querySelector(".tooltips1"); // Use tooltips1

    tooltipsTrigger1.addEventListener("click", function (event) {
        event.preventDefault();
        tooltips1.style.display = "block"; // Use tooltips1
    });

    // Close the tooltips if clicked outside
    document.addEventListener("click", function (event) {
        if (!tooltips1.contains(event.target) && event.target !== tooltipsTrigger1) {
            tooltips1.style.display = "none"; // Use tooltips1
        }
    });
});


    </script>
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
<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                <a href="../immunization/immunization.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Immunization (0-12 mos. old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming1/deworming1-4.php" class="nav-link active">
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
                                <a href="../main/weekly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Weekly Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../main/monthly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Monthly Report</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                  <a href="../main/patient.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patient Report</p>
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
              <div class="col-8">
                <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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
                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                  FOR 1-4 YEARS OLD</h5>

               
                  <div class="card-body d-flex flex-column">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-2">
                          <button type="button" class="btn btn-primary bg-gradient-primary btn-block" data-toggle="modal"
                            data-target="#add-patient"><i class="nav-icon fas fa-user-plus"></i> Add Patient
                          </button>
                        </div>
                      </div>
                    </div>

                    <?php
                    $deworming1st = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                    remarks_2nddose FROM deworming WHERE service = 'Deworming 1-4 years old'");
                    ?>

                    <table id="example" class="table table-bordered table-hover table-sm text-center">
                      <thead>
                        <tr>
                          <th>Date of Registration</th>
                          <th>Date of Birth</th>
                          <th>Name of Child</th>
                          <th>Sex</th>
                          <th>Name of Mother</th>
                          <th>Complete Address</th>
                          <th>Age</th>
                          <th>1st Dose <br>(date given)</th>
                          <th>2nd Dose <br>(date given)</th>
                          <th>Remarks</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($deworming1st)) { ?>

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
                              <?php echo $data['age']; ?>
                            </td>
                            <td>
                              <?php if ($data['1st_dose'] > 0) { ?>
                              <a class="tooltips-trigger highlight"><?php echo $data['1st_dose']; ?></a>
                          <?php } ?>
                          <div class="tooltips">
                                <?php 
                                $remarks = $data['remarks_1stdose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"><?php echo $data['remarks_1stdose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php if ($data['2nd_dose'] > 0) { ?>
                                <a class="tooltips-trigger1 highlight"><?php  echo $data['2nd_dose']; ?></a> 
                            <?php } ?>
                            <div class="tooltips1">
                                <?php 
                                $remarks = $data['remarks_2nddose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"><?php echo $data['remarks_2nddose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php echo $data['remarks']; ?>
                            </td>
                            <td>
                              <a href="edit-patient.php?did1=<?php echo $data['deworming_id']; ?>">
                                <button type="button" class="btn btn-primary btn-xs">
                                  <i class="nav-icon fas fa-edit"></i></button>
                              </a>
                              <a href="deletepatient.php?did1=<?php echo $data['deworming_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete the record?');">
                                <button type="button" class="btn btn-danger btn-xs">
                                  <i class="nav-icon fas fa-trash"></i>
                                </button></a>
                            </td>
                          </tr>

                          <?php
                        } ?>

                      </tbody>

                    </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <?php include('addpatient.php'); ?>

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
      $(function () {
        $('#example').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

  <?php } ?>
</body>

</html>








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

    <title>Deworming 1-4 years old</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="styles.css">

    <style type="text/css">


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

    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Loop through all tooltip triggers and add event listeners
    const tooltipsTriggers = document.querySelectorAll("[class^='tooltips-trigger']");
    tooltipsTriggers.forEach((tooltipsTrigger) => {
        tooltipsTrigger.addEventListener("click", function (event) {
            event.preventDefault();
            const dewormingId = this.getAttribute("class").match(/tooltips-trigger-(\d+)/)[1];
            const tooltips = document.querySelector(".tooltips-" + dewormingId);
            tooltips.style.display = "block";
        });
    });

    // Close the tooltips if clicked outside
    document.addEventListener("click", function (event) {
        tooltipsTriggers.forEach((tooltipsTrigger) => {
            const dewormingId = tooltipsTrigger.getAttribute("class").match(/tooltips-trigger-(\d+)/)[1];
            const tooltips = document.querySelector(".tooltips-" + dewormingId);
            if (!tooltips.contains(event.target) && event.target !== tooltipsTrigger) {
                tooltips.style.display = "none";
            }
        });
    });
});

// Repeat the same for the tooltips1 triggers and tooltips1 elements.

document.addEventListener("DOMContentLoaded", function () {
    // Loop through all tooltip triggers and add event listeners
    const tooltipsTriggers = document.querySelectorAll("[class^='tooltips-trigger1']");
    tooltipsTriggers.forEach((tooltipsTrigger) => {
        tooltipsTrigger.addEventListener("click", function (event) {
            event.preventDefault();
            const dewormingId = this.getAttribute("class").match(/tooltips-trigger1-(\d+)/)[1];
            const tooltips = document.querySelector(".tooltips1-" + dewormingId);
            tooltips.style.display = "block";
        });
    });

    // Close the tooltips if clicked outside
    document.addEventListener("click", function (event) {
        tooltipsTriggers.forEach((tooltipsTrigger) => {
            const dewormingId = tooltipsTrigger.getAttribute("class").match(/tooltips-trigger1-(\d+)/)[1];
            const tooltips = document.querySelector(".tooltips1-" + dewormingId);
            if (!tooltips.contains(event.target) && event.target !== tooltipsTrigger) {
                tooltips.style.display = "none";
            }
        });
    });
});

// Repeat the same for the tooltips1 triggers and tooltips1 elements.


    </script>
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
<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                <a href="../immunization/immunization.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Immunization (0-12 mos. old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming1/deworming1-4.php" class="nav-link active">
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
                                <a href="../main/weekly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Weekly Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../main/monthly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Monthly Report</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                  <a href="../main/patient.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patient Report</p>
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
              <div class="col-8">
                <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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
                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                  FOR 1-4 YEARS OLD</h5>

               
                  <div class="card-body d-flex flex-column">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-2">
                          <button type="button" class="btn btn-primary bg-gradient-primary btn-block" data-toggle="modal"
                            data-target="#add-patient"><i class="nav-icon fas fa-user-plus"></i> Add Patient
                          </button>
                        </div>
                      </div>
                    </div>

                    <?php
                    $deworming1st = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                    remarks_2nddose FROM deworming WHERE service = 'Deworming 1-4 years old'");
                    ?>

                    <table id="example" class="table table-bordered table-hover table-sm text-center">
                      <thead>
                        <tr>
                          <th>Date of Registration</th>
                          <th>Date of Birth</th>
                          <th>Name of Child</th>
                          <th>Sex</th>
                          <th>Name of Mother</th>
                          <th>Complete Address</th>
                          <th>Age</th>
                          <th>1st Dose <br>(date given)</th>
                          <th>2nd Dose <br>(date given)</th>
                          <th>Remarks</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($deworming1st)) { ?>

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
                              <?php echo $data['age']; ?>
                            </td>
                            <td>
                              <?php if ($data['1st_dose'] > 0) { ?>
                                      <a class="tooltips-trigger-<?php echo $data['deworming_id']; ?> highlight"><?php echo $data['1st_dose']; ?></a>
                                <?php } ?>
                                <div class="tooltips-<?php echo $data['deworming_id']; ?>">
                                <?php 
                                $remarks = $data['remarks_1stdose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"><?php echo $data['remarks_1stdose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php if ($data['2nd_dose'] > 0) { ?>
                                <a class="tooltips-trigger1-<?php echo $data['deworming_id']; ?> highlight"><?php echo $data['2nd_dose']; ?></a>
                            <?php } ?>
                            <div class="tooltips1-<?php echo $data['deworming_id']; ?>">
                                <?php 
                                $remarks = $data['remarks_2nddose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"><?php echo $data['remarks_2nddose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php echo $data['remarks']; ?>
                            </td>
                            <td>
                              <a href="edit-patient.php?did1=<?php echo $data['deworming_id']; ?>">
                                <button type="button" class="btn btn-primary btn-xs">
                                  <i class="nav-icon fas fa-edit"></i></button>
                              </a>
                              <a href="deletepatient.php?did1=<?php echo $data['deworming_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete the record?');">
                                <button type="button" class="btn btn-danger btn-xs">
                                  <i class="nav-icon fas fa-trash"></i>
                                </button></a>
                            </td>
                          </tr>

                          <?php
                        } ?>

                      </tbody>

                    </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <?php include('addpatient.php'); ?>

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
      $(function () {
        $('#example').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

  <?php } ?>
</body>

</html>




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

    <title>Deworming 1-4 years old</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="styles.css">

    <style type="text/css">


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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
          const tooltipsTrigger = document.querySelector(".tooltips-trigger");
          const tooltips = document.querySelector(".tooltips");

          tooltipsTrigger.addEventListener("click", function (event) {
            event.preventDefault();
            tooltips.style.display = "block";
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
            if (!tooltips.contains(event.target) && event.target !== tooltipsTrigger) {
              tooltips.style.display = "none";
            }
          });
        });

        document.addEventListener("DOMContentLoaded", function () {
          const tooltipsTrigger = document.querySelector(".tooltips-trigger1");
          const tooltips = document.querySelector(".tooltips1");

          tooltipsTrigger.addEventListener("click", function (event) {
            event.preventDefault();
            tooltips.style.display = "block";
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
            if (!tooltips.contains(event.target) && event.target !== tooltipsTrigger) {
              tooltips.style.display = "none";
            }
          });
        });

    </script>
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
<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                <a href="../immunization/immunization.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Immunization (0-12 mos. old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming1/deworming1-4.php" class="nav-link active">
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
                                <a href="../main/weekly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Weekly Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../main/monthly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Monthly Report</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                  <a href="../main/patient.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patient Report</p>
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
              <div class="col-8">
                <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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
                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                  FOR 1-4 YEARS OLD</h5>

               
                  <div class="card-body d-flex flex-column">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-2">
                          <button type="button" class="btn btn-primary bg-gradient-primary btn-block" data-toggle="modal"
                            data-target="#add-patient"><i class="nav-icon fas fa-user-plus"></i> Add Patient
                          </button>
                        </div>
                      </div>
                    </div>

                    <?php
                    $deworming1st = mysqli_query($con, "SELECT deworming_id, service, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                    purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                    remarks_2nddose FROM deworming WHERE service = 'Deworming 1-4 years old'");
                    ?>

                    <table id="example" class="table table-bordered table-hover table-sm text-center">
                      <thead>
                        <tr>
                          <th>Date of Registration</th>
                          <th>Date of Birth</th>
                          <th>Name of Child</th>
                          <th>Sex</th>
                          <th>Name of Mother</th>
                          <th>Complete Address</th>
                          <th>Age</th>
                          <th>1st Dose <br>(date given)</th>
                          <th>2nd Dose <br>(date given)</th>
                          <th>Remarks</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($deworming1st)) { ?>

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
                              <?php echo $data['age']; ?>
                            </td>
                            <td>
                              <?php if ($data['1st_dose'] > 0) { ?>
                              <a class="tooltips-trigger highlight"><?php echo $data['1st_dose']; ?></a>
                          <?php } ?>
                          <div class="tooltips">
                                <?php 
                                $remarks = $data['remarks_1stdose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>1st Dose:</p>
                                    <textarea name="remarks_1stdose" rows="5"><?php echo $data['remarks_1stdose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit1" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php if ($data['2nd_dose'] > 0) { ?>
                                <a class="tooltips-trigger1 highlight"><?php  echo $data['2nd_dose']; ?></a> 
                            <?php } ?>
                            <div class="tooltips1">
                                <?php 
                                $remarks = $data['remarks_2nddose'];
                                if( $remarks == NULL) { ?>
                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } else { ?>

                                <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>2nd Dose:</p>
                                    <textarea id="remarks" name="remarks_2nddose" rows="5"><?php echo $data['remarks_2nddose']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['deworming_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                </form>
                            <?php } ?>
                            </div>
                            </td>
                            <td>
                              <?php echo $data['remarks']; ?>
                            </td>
                            <td>
                              <a href="edit-patient.php?did1=<?php echo $data['deworming_id']; ?>">
                                <button type="button" class="btn btn-primary btn-xs">
                                  <i class="nav-icon fas fa-edit"></i></button>
                              </a>
                              <a href="deletepatient.php?did1=<?php echo $data['deworming_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete the record?');">
                                <button type="button" class="btn btn-danger btn-xs">
                                  <i class="nav-icon fas fa-trash"></i>
                                </button></a>
                            </td>
                          </tr>

                          <?php
                        } ?>

                      </tbody>

                    </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <?php include('addpatient.php'); ?>

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
      $(function () {
        $('#example').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

  <?php } ?>
</body>

</html>