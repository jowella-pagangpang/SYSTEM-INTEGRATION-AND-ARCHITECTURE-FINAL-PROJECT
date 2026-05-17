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

    <title>Weekly Report</title>
    <link rel="icon" href="../../img/logo.png">

    <style>
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
                                <a href="../main/weekly.php" class="nav-link active">
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
              <h4 class="font-weight-bold" style="font-family: Helvetica;">WEEKLY REPORT</h4>
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

              <form method="post" action="reportweekly.php">
                <div class="card-body d-flex flex-column">
                  <div class="card-block">
                    <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <select class="form-control form-control-sm" style="width: 100%;" name="service" required>
                          <option selected disabled value="">Select Health Service</option>
                            <option value="immunization">Immunization (0-12 mos. old)</option>
                            <option value="deworming">Deworming Services</option>
                            <option value="nutrition1">Nutrition and EPI Program I</option>
                            <option value="nutrition2">Nutrition and EPI Program II</option>
                            <option value="sickchildren">Sick Children</option>
                            <option value="maternal">Maternal Care</option>
                            <option value="postpartum">Postpartum Care</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input type="date" name="date" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-2">
                        <button type="submit" class="btn btn-primary bg-gradient-primary btn-sm btn-block btn-sm">
                          Generate
                        </button>
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

                <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="../main/dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
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
                                <a href="../main/weekly.php" class="nav-link active">
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
              <h4 class="font-weight-bold" style="font-family: Helvetica;">WEEKLY REPORT</h4>
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

              <form method="post" action="reportweekly-nurse.php">
                <div class="card-body d-flex flex-column">
                  <div class="card-block">
                    <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                          <select class="form-control form-control-sm" style="width: 100%;" name="service" required>
                          <option selected disabled value="">Select Health Service</option>
                            <option value="immunization">Immunization (0-12 mos. old)</option>
                            <option value="deworming">Deworming Services</option>
                            <option value="nutrition1">Nutrition and EPI Program I</option>
                            <option value="nutrition2">Nutrition and EPI Program II</option>
                            <option value="sickchildren">Sick Children</option>
                            <option value="maternal">Maternal Care</option>
                            <option value="postpartum">Postpartum Care</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input type="date" name="date" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-2">
                        <button type="submit" class="btn btn-primary bg-gradient-primary btn-block btn-sm">
                          Enter
                        </button>
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
    $(function () {
      $('#example').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <?php } ?>

</body>

</html>