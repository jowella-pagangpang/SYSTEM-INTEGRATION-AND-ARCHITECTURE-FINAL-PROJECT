<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');

// Define an array to store the years
$years = array();

$tables = array('deworming', 'immunization', 'nutrition2', 'maternal', 'postpartum', 'sickchildren');

foreach ($tables as $table) {
    if ($table === 'postpartum') {
        $sql = "SELECT DISTINCT YEAR(delivery_date) AS year FROM $table";
    } else {
        $sql = "SELECT DISTINCT YEAR(reg_date) AS year FROM $table";
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $years[] = $row['year'];
        }
    }
}

// Remove duplicates and sort the years in descending order
$years = array_unique($years);
rsort($years);


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

    <title>Custom Report</title>
    <link rel="icon" href="../../img/logo.png">

    <style>
      .form-control:focus {
          border-color: #007bff; 
          box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
          outline: none; 
      }
      #monthlyDiv {
        display: none;
      }
      #weeklyDiv {
        display: none;
      }
      #rangeDiv {
        display: none;
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
                                  <a href="../main/report.php" class="nav-link active">
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

              <form method="post" action="newreport.php">

                <div class="card-body d-flex flex-column">
                  <div class="card-block">
                    <div class="row">
                      <div class="col-4">
                      </div>
                    <div class="col-4">
                      <div class="form-group">
                          <select class="form-control" style="width: 100%;" name="service">
                          <option selected disabled value="">Select Health Service</option>
                            <option value="immunization">Immunization Services</option>
                            <option value="deworming">Deworming Services</option>
                            <option value="nutrition2">Nutrition Program</option>
                            <option value="sickchildren">Sick Children</option>
                            <option value="maternal">Maternal Care</option>
                            <option value="postpartum">Postpartum Care</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-4">
                      </div>
                    <div class="col-4">
                      <div class="form-group">
                          <select class="form-control" style="width: 100%;" name="frequency" id="frequency">
                          <option selected disabled value="">Select Report</option>
                            <option value="weekly">Weekly Report</option>
                            <option value="monthly">Monthly Report</option>
                            <option value="range">Date Range Report </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                      </div>
                    </div>


                    <div id="monthlyDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-2">
                          <div class="form-group">
                          <p class="font-weight-bold">SELECT MONTH:</p>
                              <select class="form-control" style="width: 100%;" name="month">
                              <option selected disabled value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                            </div>
                          </div>
                        <div class="col-2">
                            <div class="form-group">
                                <p class="font-weight-bold">SELECT YEAR:</p>
                                <select class="form-control" style="width: 100%;" name="year">
                                    <option selected disabled value="">Year</option>
                                    <?php foreach ($years as $year) { ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div id="weeklyDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-4">
                        <div class="form-group">
                          <p class="font-weight-bold">SELECT DATE:</p>
                          <input type="date" name="week" class="form-control">
                        </div>
                          </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div id="rangeDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-2">
                        <div class="form-group">
                          <p class="font-weight-bold">FROM:</p>
                          <input type="date" name="fromDate" class="form-control">
                        </div>
                          </div>
                        <div class="col-2">
                        <div class="form-group">
                          <p class="font-weight-bold">TO:</p>
                          <input type="date" name="toDate" class="form-control">
                        </div>
                          </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div class="row">
                      <div class="col-5">
                      </div>
                      <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary bg-gradient-primary btn-block">
                          Generate
                        </button>
                      </div>
                      <div class="col-5">
                      </div>
                    </div>


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
                                  <a href="../main/report.php" class="nav-link active">
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

              <form method="post" action="newreport-nurse.php">

                <div class="card-body d-flex flex-column">
                  <div class="card-block">
                    <div class="row">
                      <div class="col-4">
                      </div>
                    <div class="col-4">
                      <div class="form-group">
                          <select class="form-control" style="width: 100%;" name="service">
                          <option selected disabled value="">Select Health Service</option>
                            <option value="immunization">Immunization Services</option>
                            <option value="deworming">Deworming Services</option>
                            <option value="nutrition2">Nutrition Program</option>
                            <option value="sickchildren">Sick Children</option>
                            <option value="maternal">Maternal Care</option>
                            <option value="postpartum">Postpartum Care</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-4">
                      </div>
                    <div class="col-4">
                      <div class="form-group">
                          <select class="form-control" style="width: 100%;" name="frequency" id="frequency">
                          <option selected disabled value="">Select Report</option>
                            <option value="weekly">Weekly Report</option>
                            <option value="monthly">Monthly Report</option>
                            <option value="range">Date Range Report </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                      </div>
                    </div>


                    <div id="monthlyDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-2">
                          <div class="form-group">
                          <p class="font-weight-bold">SELECT MONTH:</p>
                              <select class="form-control" style="width: 100%;" name="month">
                              <option selected disabled value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                            </div>
                          </div>
                        <div class="col-2">
                            <div class="form-group">
                                <p class="font-weight-bold">SELECT YEAR:</p>
                                <select class="form-control" style="width: 100%;" name="year">
                                    <option selected disabled value="">Year</option>
                                    <?php foreach ($years as $year) { ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div id="weeklyDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-4">
                        <div class="form-group">
                          <p class="font-weight-bold">SELECT DATE:</p>
                          <input type="date" name="week" class="form-control">
                        </div>
                          </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div id="rangeDiv">
                    <div class="row">
                      <div class="col-4">
                      </div>
                        <div class="col-2">
                        <div class="form-group">
                          <p class="font-weight-bold">FROM:</p>
                          <input type="date" name="fromDate" class="form-control">
                        </div>
                          </div>
                        <div class="col-2">
                        <div class="form-group">
                          <p class="font-weight-bold">TO:</p>
                          <input type="date" name="toDate" class="form-control">
                        </div>
                          </div>
                      <div class="col-4">
                      </div>
                    </div>
                </div>


                    <div class="row">
                      <div class="col-5">
                      </div>
                      <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary bg-gradient-primary btn-block">
                          Generate
                        </button>
                      </div>
                      <div class="col-5">
                      </div>
                    </div>


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

  <?php } ?>

  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- page script -->
   <script>
        const frequencySelect = document.getElementById('frequency');
        const monthlyDiv = document.getElementById('monthlyDiv');
        const weeklyDiv = document.getElementById('weeklyDiv');
        const dateDiv = document.getElementById('rangeDiv');

        frequencySelect.addEventListener('change', function() {
          if (frequencySelect.value === 'monthly') {
            monthlyDiv.style.display = 'block';
          } else {
            monthlyDiv.style.display = 'none';
          }

          if (frequencySelect.value === 'weekly') {
            weeklyDiv.style.display = 'block';
          } else {
            weeklyDiv.style.display = 'none';
          }

          if (frequencySelect.value === 'range') {
            rangeDiv.style.display = 'block';
          } else {
            rangeDiv.style.display = 'none';
          }


        });
      </script>

  <?php } ?>

</body>

</html>