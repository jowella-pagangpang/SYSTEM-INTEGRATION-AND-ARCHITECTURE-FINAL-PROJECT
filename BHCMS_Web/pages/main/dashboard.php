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

      <title>Dashboard</title>
      <link rel="icon" href="../../img/logo.png">

      <style>
      .form-control:focus {
        border-color: #007bff; 
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
        outline: none; 
      }

      .small-box {
        transition: transform 0.3s, box-shadow 0.3s;
      }

      .small-box:hover {
        transform: scale(1.05); 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); 
      }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

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
            <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">Health Record Management</span>
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
                            <a href="../main/dashboard.php" class="nav-link active">
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
                        <li class="nav-item">
                          <a href="../../api-sync-logs.php" class="nav-link">
                            <i class="nav-icon fas fa-sync-alt"></i>
                            <p>
                              API Sync Logs
                            </p>
                            </a>
                        </li>
                    </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="font-family: Helvetica;">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row">
                <div class="col-8">
                  <h4 class="font-weight-bold">TARGET CLIENT LIST</h4>
                </div>
                <div class="col-4">
<!-- Dashboard.php -->
<form method="post" action="searchresult.php">
    <div class="input-group input-group-sm">
        <input class="form-control" type="search" name="search1" placeholder="Search client name" autocomplete="off" oninput="validateInput(this)">
        <button class="btn btn-navbar" type="submit"><i class="nav-icon fas fa-search fa-lg"></i></button>
                  </div>
                </form>

                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <br><br>

          <!-- Main content -->
            <section class="content" style="font-family: Helvetica;">
              <div class="container-fluid">
                <p class="font-weight-bold" style="font-size:22px;">TOTAL CLIENTS</p>
                <!-- Small boxes (Stat box) -->
               <div class="row">

               <div class="col-lg-4 col-md-6">
          <!-- small box -->
          <div class="small-box" style="background-color: #90EE90">
            <div class="inner">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h1 class="font-weight-bold" id="immunization-total">
                    <?php
                    $immunization = mysqli_query($con, "SELECT * from immunization");
                    $immunization_total = mysqli_num_rows($immunization);
                    echo $immunization_total;
                    ?>
                  </h1>
                  <p class="font-weight-bold">Immunization Services<br> for 0-12 months old</p>
                </div>
                <img src="../../img/vaccine.png" alt="Immunization" style="max-width: 100px; height: auto;">
              </div>
            </div>
            <br>
            <a href="../immunization/immunization.php" class="small-box-footer text-dark">Manage List <i
              class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


<div class="col-lg-4 col-md-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FBEC5D;">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="d1-total">
            <?php
            $d1 = mysqli_query($con, "SELECT * from deworming");
            $d1_total = mysqli_num_rows($d1);
            echo $d1_total;
            ?>
          </h1>
          <p class="font-weight-bold">Deworming Services<br>&nbsp;</p>
        </div>
        <img src="../../img/tablets.png" alt="Deworming" style="max-width: 100px; height: auto;">
      </div>
    </div>
    <br>
    <a href="../deworming1/deworming.php" class="small-box-footer text-dark">Manage List <i
    class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-md-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #C0C0C0">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="n2-total">
          <?php
            $n2 = mysqli_query($con, "SELECT * from nutrition2");
            $n2_total = mysqli_num_rows($n2);
            echo $n2_total;
          ?>
          </h1>
          <p class="font-weight-bold">Nutrition and Expanded<br> Program for Immunization</p>
        </div>
        <img src="../../img/nutrition.png" alt="Nutrition Program" style="max-width: 100px; height: auto;">
      </div>
    </div>
    <br>
    <a href="../nutrition2/nutrition2.php" class="small-box-footer text-dark">Manage List <i
    class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->

                </div>
                <!-- /.row -->

                <div class="row">                  

<div class="col-lg-4 col-md-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FFB366">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="sc-total">
          <?php
          $sc = mysqli_query($con, "SELECT * from sickchildren");
          $sc_total = mysqli_num_rows($sc);
          echo $sc_total;
          ?>
          </h1>
          <p class="font-weight-bold">Sick Children</p>
        </div>
        <img src="../../img/sick.png" alt="Sick Children" style="max-width: 100px; height: auto;">
      </div>
    </div>
    <br>
    <a href="../sickchildren/sickchildren.php" class="small-box-footer text-dark">Manage List <i
    class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-md-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FFB6C1">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="maternal-total">
          <?php
          $maternal = mysqli_query($con, "SELECT * from maternal");
          $maternal_total = mysqli_num_rows($maternal);
          echo $maternal_total;
          ?>
          </h1>
          <p class="font-weight-bold"style=>Maternal Care</p>
        </div>
        <img src="../../img/pregnant.png" alt="Maternal Care" style="max-width: 100px; height: auto;">
      </div>
    </div>
    <br>
    <a href="../maternal/maternal.php" class="small-box-footer text-dark">Manage List <i
    class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-md-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #87CEEB">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="p-total">
          <?php
          $p = mysqli_query($con, "SELECT * from postpartum");
          $p_total = mysqli_num_rows($p);
          echo $p_total;
          ?>
          </h1>
          <p class="font-weight-bold">Postpartum Care</p>
        </div>
        <img src="../../img/postpartum.png" alt="Postpartum Care" style="max-width: 100px; height: auto;">
      </div>
    </div>
    <br>
    <a href="../postpartum/postpartum.php" class="small-box-footer text-dark">Manage List <i
    class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
                </div>
                <!-- /.row -->

              </div>
              <!-- /.card -->

            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->



    <?php } elseif ($_SESSION['type'] == "Nurse") {
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
                            <a href="../main/dashboard.php" class="nav-link active">
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
                    </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="font-family: Helvetica;">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row">
                <div class="col-8">
                  <h4 class="font-weight-bold">TARGET CLIENT LIST</h4>
                </div>
                <div class="col-4">

                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <br><br>

          <!-- Main content -->
            <section class="content" style="font-family: Helvetica;">
              <div class="container-fluid">
                <p class="font-weight-bold" style="font-size:22px;">TOTAL CLIENTS</p>
                <!-- Small boxes (Stat box) -->
                <div class="row">

<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #90EE90">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="immunization-total">
            <?php
            $immunization = mysqli_query($con, "SELECT * from immunization");
            $immunization_total = mysqli_num_rows($immunization);
            echo $immunization_total;
            ?>
          </h1>
          <p class="font-weight-bold">Immunization for<br> 0-12 months old</p>
        </div>
        <img src="../../img/vaccine.png" alt="Immunization" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FBEC5D">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="d1-total">
            <?php
            $d1 = mysqli_query($con, "SELECT * from deworming");
            $d1_total = mysqli_num_rows($d1);
            echo $d1_total;
            ?>
          </h1>
          <p class="font-weight-bold">Deworming Services<br>&nbsp;</p>
        </div>
        <img src="../../img/tablets.png" alt="Deworming" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #C0C0C0">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="n2-total">
          <?php
            $n2 = mysqli_query($con, "SELECT * from nutrition2");
            $n2_total = mysqli_num_rows($n2);
            echo $n2_total;
          ?>
          </h1>
          <p class="font-weight-bold">Nutrition and Expanded<br> Program for Immunization</p>
        </div>
        <img src="../../img/nutrition.png" alt="Nutrition Program" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->

                </div>
                <!-- /.row -->

                <div class="row">                  

<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FFB366">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="sc-total">
          <?php
          $sc = mysqli_query($con, "SELECT * from sickchildren");
          $sc_total = mysqli_num_rows($sc);
          echo $sc_total;
          ?>
          </h1>
          <p class="font-weight-bold">Sick Children</p>
        </div>
        <img src="../../img/sick.png" alt="Sick Children" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #FFB6C1">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="maternal-total">
          <?php
          $maternal = mysqli_query($con, "SELECT * from maternal");
          $maternal_total = mysqli_num_rows($maternal);
          echo $maternal_total;
          ?>
          </h1>
          <p class="font-weight-bold">Maternal Care</p>
        </div>
        <img src="../../img/pregnant.png" alt="Maternal Care" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->

                  <div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box" style="background-color: #87CEEB">
    <div class="inner">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="font-weight-bold" id="p-total">
          <?php
          $p = mysqli_query($con, "SELECT * from postpartum");
          $p_total = mysqli_num_rows($p);
          echo $p_total;
          ?>
          </h1>
          <p class="font-weight-bold">Postpartum Care</p>
        </div>
        <img src="../../img/postpartum.png" alt="Postpartum Care" style="max-width: 100px;">
      </div>
    </div>
    <br>
  </div>
</div>
<!-- ./col -->
                </div>
                <!-- /.row -->

              </div>
              <!-- /.card -->

            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
    
    <?php }
} ?>

<script>
function validateInput(inputElement) {
    let inputValue = inputElement.value;
    let lettersOnly = inputValue.replace(/[^a-zA-Z\s.]/g, '');

    if (inputValue !== lettersOnly) {
        let selectionStart = inputElement.selectionStart;
        let selectionEnd = inputElement.selectionEnd;

        inputElement.value = lettersOnly;

        // Restore cursor position
        inputElement.setSelectionRange(selectionStart, selectionEnd);
    }
}
  </script>

<script>
  // Function to animate the numbers
  function animateNumbers(element, finalValue, duration) {
    let currentValue = 0;
    const step = (finalValue / duration) * 30;

    function updateValue() {
      currentValue += step;
      if (currentValue <= finalValue) {
        element.textContent = Math.round(currentValue);
        requestAnimationFrame(updateValue);
      } else {
        element.textContent = finalValue;
      }
    }

    requestAnimationFrame(updateValue);
  }

  // Trigger the animation when the page loads
  window.addEventListener("load", function () {
    const immunizationElement = document.querySelector("#immunization-total");
    const d1Element = document.querySelector("#d1-total");
    const n2Element = document.querySelector("#n2-total");
    const scElement = document.querySelector("#sc-total");
    const maternalElement = document.querySelector("#maternal-total");
    const pElement = document.querySelector("#p-total");

    animateNumbers(immunizationElement, <?php echo $immunization_total; ?>, 1000);
    animateNumbers(d1Element, <?php echo $d1_total; ?>, 1000);
    animateNumbers(n2Element, <?php echo $n2_total; ?>, 1000);
    animateNumbers(scElement, <?php echo $sc_total; ?>, 1000);
    animateNumbers(maternalElement, <?php echo $maternal_total; ?>, 1000);
    animateNumbers(pElement, <?php echo $p_total; ?>, 1000);
  });
</script>


</body>

</html>