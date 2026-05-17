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

    <title>Nutrition and EPI Part I</title>
    <link rel="icon" href="../../img/logo.png">

    <style>
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
                                <a href="../nutrition1/nutrition1.php" class="nav-link active">
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
                                  <a href="../main/report.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Generate Report</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="../main/client.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Client Report</p>
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
              <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR NUTRITION AND
                EXPANDED PROGRAM FOR IMMUNIZATION PART I</h5>

              <form method="post">
                <div class="card-body d-flex flex-column">
                  <div class="card-block">
                    <div class="row">
                      <div class="col-2">
                        <div class="form-group">
                        <a href="../main/download-n1.php" class="btn btn-success bg-gradient-success btn-block btn-sm">
                        <i class="nav-icon fas fa-download"></i> Download</a>
                      </div>
                      </div>
                    </div>
                  </div>

                    <?php
                    $nutrition1 = mysqli_query($con, "SELECT nutrition1_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, weight, height, sex, mother_name, 
                    purok, address, DATE_FORMAT(screening_done,'%m-%d-%Y') AS done, tetanus_status, 
                    DATE_FORMAT(date_ttstatus,'%m-%d-%Y') AS datett, DATE_FORMAT(date_assess,'%m-%d-%Y') AS assess 
                    FROM nutrition1 
                    INNER JOIN client ON nutrition1.patientid = client.id");
                    ?>

                        <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                          width="100%">
                          <thead>
                            <tr>
                              <th rowspan="2">Name of Child</th>
                              <th rowspan="2">Date of Registration</th>
                              <th rowspan="2">Sex</th>
                              <th rowspan="2" class="font-weight-normal"><b>Weight</b> <br>(kg)</th>
                              <th rowspan="2" class="font-weight-normal"><b>Height</b> <br>(cm)</th>
                              <th>Date Newborn <br>Screening</th>
                              <th colspan="2">Child Protected at Birth (CPAB)</th>
                              <th rowspan="2">View</th>
                            </tr>
                            <tr>
                              <th>Done</th>
                              <th>TT Status <br>/ Date</th>
                              <th>Date Assess</th>
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
                                  <?php echo $data['sex']; ?>
                                </td>
                                  <td>
                                    <?php if ($data['weight'] > 0) {
                                      echo $data['weight'] . ' kg';
                                    }
                                    ; ?>
                                  </td>
                                  <td>
                                    <?php if ($data['height'] > 0) {
                                      echo $data['height'] . ' cm';
                                    }
                                    ; ?>
                                    </td>
                                <td>
                                  <?php if($data['done'] != '00-00-0000') {echo $data['done'];}; ?>
                                </td>
                                <td>
                                  <?php echo $data['tetanus_status']; ?><br>
                                <?php if($data['datett'] != '00-00-0000') {echo $data['datett'];}; ?>
                                </td>
                                <td>
                                  <?php if($data['assess'] != '00-00-0000') {echo $data['assess'];}; ?>
                                </td>
                                <td>
                                  <a href="../client/nutrition1-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>
                              <?php
                            } ?>
                          </tbody>
                        </table>
                        
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


    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>

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
            $(document).ready(function() {
                var table = $('#example').DataTable();

                $('#example_filter input').on('keyup', function() {
                    var searchTerm = this.value;
                
                    table.column([0]).search(searchTerm).draw();
                });
            });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
      }); 
    </script>

  <?php } ?>

</body>

</html>