<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if(!isset($_SESSION['type'])){
  header("Location: ../../index.php");
  exit();
}

$apiOnline = false;
$allClients = 0;
$generalConsultations = 0;

$apiUrl = "https://localhost:44315/api/Clients";
$apiKey = "bims-secret-key-2024";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-API-KEY: $apiKey"]);
$response = curl_exec($ch);
curl_close($ch);

if($response){
  $data = json_decode($response, true);
  if(is_array($data)){
    $apiOnline = true;
    $allClients = count($data);
    $generalConsultations = 0;
  }
}
?>

<head>
  <?php include('../headsidecss.php'); ?>
  <title>Dashboard</title>
  <link rel="icon" href="../../img/logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-dark"
      style="background-color:#343a40;">

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
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
  <h1 class="brand-link text-center">
    <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">
      Health Record Management
    </span>
  </h1>

  <div class="sidebar">
    <div class="user-panel pb-3 mb-3 text-center">
      <img src="../../img/basak logo.png" style="height: 40%; width: 40%;" alt="logo">
    </div>

    <nav class="mt-2" style="font-family: Helvetica;">
      <ul class="nav nav-pills nav-sidebar flex-column text-sm">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../client/client-list.php" class="nav-link">
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
          <a href="../logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<div class="content-wrapper" style="font-family: Helvetica;">
  <div class="content-header">
    <div class="container-fluid">
      <h4 class="font-weight-bold" style="font-size:40px; font-family: 'Poppins',sans-serif">DASHBOARD</h4>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <?php if(!$apiOnline){ ?>
        <div class="alert alert-danger">
          API server is offline. Data cannot be loaded.
        </div>
      <?php } ?>

      <div class="row">
        <div class="col-md-12">
    <div class="card">

      <div class="card-body">

        <h5 class="font-weight-bold">
          Welcome to Barangay Health Record Management System
        </h5>

        <p>
          This dashboard provides an overview of client records
          and health consultation information. It helps monitor
          and manage barangay health services efficiently.
        </p>

        <hr>

      </div>

    </div>
  </div>
        <div class="col-lg-6 col-md-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h1 class="font-weight-bold"><?php echo $allClients; ?></h1>
              <p class="font-weight-bold">All Clients</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="../client/client-list.php" class="small-box-footer">
              Manage List <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h1 class="font-weight-bold"><?php echo $generalConsultations; ?></h1>
              <p class="font-weight-bold">General Consultations</p>
            </div>
            <div class="icon">
              <i class="fas fa-notes-medical"></i>
            </div>
            <a href="../client/general-consult.php" class="small-box-footer">
              Manage List <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

</div>

<?php include('../footer.php'); ?>
</body>
</html>