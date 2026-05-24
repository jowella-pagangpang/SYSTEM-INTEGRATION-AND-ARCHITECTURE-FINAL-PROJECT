<?php
include('../dbcon.php');
session_start();

if(!isset($_SESSION['type'])){
  header("Location: ../../index.php");
  exit();
}

$id = $_GET['id'];

$client = mysqli_query($con, "SELECT * FROM clients WHERE client_id='$id'");
$c = mysqli_fetch_assoc($client);

$records = mysqli_query($con, "SELECT * FROM general_consultations WHERE client_id='$id' ORDER BY consult_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../headsidecss.php'); ?>
  <title>Client Record</title>
  <link rel="icon" href="../../img/logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: Helvetica, Arial, sans-serif;
    }

    .record-title {
      font-size: 35px;
      font-family: 'Poppins', sans-serif;
      letter-spacing: 2px;
    }

    .record-card {
      border-radius: 8px;
    }

    .info-box-custom {
      padding: 12px;
      border: 1px solid #dee2e6;
      border-radius: 6px;
      min-height: 75px;
      background: #f8f9fa;
    }

    .info-label {
      font-weight: bold;
      color: #343a40;
    }

    @media print {
      .no-print,
      .main-sidebar,
      .main-header {
        display: none !important;
      }

      .content-wrapper {
        margin-left: 0 !important;
        margin-top: 0 !important;
      }

      .card {
        box-shadow: none !important;
        border: none !important;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-dark no-print" style="background-color:#343a40;">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#">
          <i class="fas fa-bars"></i>
        </a>
      </li>

      <li class="nav-item">
        <span class="nav-link font-weight-bold">
          Barangay Health Worker
        </span>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand no-print">
    <h1 class="brand-link text-center">
      <span class="brand-text font-weight-bold" style="font-size:17px;">
        Health Record Management
      </span>
    </h1>

    <div class="sidebar">
      <div class="user-panel pb-3 mb-3 text-center">
        <img src="../../img/basak logo.png" style="height:40%; width:40%;" alt="Logo">
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm">

          <li class="nav-item">
            <a href="../main/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../client/client-list.php" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>All Clients</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../client/general-consult.php" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>General Consultations</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../../index.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">

    <div class="content-header no-print">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="font-weight-bold record-title mb-0">
            CLIENT RECORD
          </h1>

          <div>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
              <i class="fas fa-print"></i> Print
            </button>

            <a href="client-list.php" class="btn btn-dark btn-sm">
              <i class="fas fa-arrow-left"></i> Back
            </a>
          </div>
        </div>
      </div>
    </div>

    <section class="content text-sm">
      <div class="container-fluid">

        <div class="card record-card">
          <div class="card-body">

            <h4 class="font-weight-bold text-center">
              Barangay Health Center Client Record
            </h4>

            <hr>

            <h5 class="font-weight-bold mb-4">
              <?php
                echo $c['fname'].' '.$c['mname'].' '.$c['surname'];
              ?>
            </h5>

            <div class="row">
              <div class="col-md-4">
                <p><b>Birthdate:</b>
                  <?php echo $c['bday'];?>
                </p>

              </div>
              <div class="col-md-4">
                <p><b>Sex:</b>
                  <?php echo $c['sex'];?>
                </p>
              </div>
              <div class="col-md-4">
                <p><b>Purok:</b>
                  <?php echo $c['purok'];?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p>
                  <b>Date Added:</b>
                    <?php echo $c['date_added'];?>
                </p>
              </div>
            </div>

            <hr>

            <h5 class="font-weight-bold mb-3">
              Consultation History
            </h5>

            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                  <tr>
                    <th>Date</th>
                    <th>Concern</th>
                    <th>Medicine / Action Taken</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if(mysqli_num_rows($records) > 0){ ?>
                    <?php while($r = mysqli_fetch_assoc($records)){ ?>
                      <tr>
                        <td><?php echo $r['date_added']; ?></td>
                        <td><?php echo $r['concern']; ?></td>
                        <td><?php echo $r['medicine_given']; ?></td>
                        <td><?php echo $r['action_status']; ?></td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="4">No consultation record yet.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </section>

  </div>

</div>

</body>
</html>