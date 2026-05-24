<?php
session_start();

if(!isset($_SESSION['type'])){
  header("Location: ../../index.php");
  exit();
}

$API_BASE = "https://localhost:44315/api";
$API_KEY = "bims-secret-key-2024";
$message = "";
$apiOnline = true;

function api_request($method, $endpoint, $data = null){
  global $API_BASE, $API_KEY;

  $ch = curl_init($API_BASE . $endpoint);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-API-KEY: $API_KEY",
    "Content-Type: application/json"
  ]);

  if($data != null){
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  }

  $res = curl_exec($ch);
  $err = curl_error($ch);
  curl_close($ch);

  if($err || !$res) return null;
  return json_decode($res, true);
}

if(isset($_GET['done'])){
  $id = intval($_GET['done']);
  $done = api_request("PUT", "/GeneralConsultations/".$id."/done");
  $message = $done ? "Consultation marked as done." : "API offline. Cannot update status.";
}

$consultations = api_request("GET", "/GeneralConsultations");

if(!is_array($consultations)){
  $consultations = [];
  $apiOnline = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../headsidecss.php'); ?>
  <title>General Consultation</title>
  <link rel="icon" href="../../img/logo.png">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

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
          <a href="../main/dashboard.php" class="nav-link">
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
          <a href="../client/general-consult.php" class="nav-link active">
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

<div class="content-wrapper" style="font-family: Helvetica;">
  <div class="content-header">
    <div class="container-fluid">
      <h4 class="font-weight-bold">GENERAL CONSULTATIONS</h4>
    </div>
  </div>

  <section class="content text-sm">
    <div class="container-fluid">

      <?php if($message!=""){ ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
      <?php } ?>

      <?php if(!$apiOnline){ ?>
        <div class="alert alert-danger">
          API server is offline. Consultation data cannot be loaded.
        </div>
      <?php } ?>

      <div class="card">
        <div class="card-header">
          <b>Consultation Records</b>
        </div>

        <div class="card-body">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-lightblue">
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Birthdate</th>
                <th>Purok</th>
                <th>Concern</th>
                <th>Medicine / Action</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php if(count($consultations)>0){ ?>
                <?php foreach($consultations as $row){ ?>
                <tr>
                  <td><?php echo $row['date_added']; ?></td>
                  <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['surname']; ?></td>
                  <td><?php echo $row['sex']; ?></td>
                  <td><?php echo $row['bday']; ?></td>
                  <td><?php echo $row['purok']; ?></td>
                  <td><?php echo $row['concern']; ?></td>
                  <td><?php echo $row['medicine_given']; ?></td>
                  <td>
                    <?php if($row['action_status']=="Pending"){ ?>
                      <span class="badge badge-warning">Pending</span>
                    <?php } else { ?>
                      <span class="badge badge-success">Done</span>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($row['action_status']=="Pending"){ ?>
                      <a href="general-consult.php?done=<?php echo $row['consult_id']; ?>" class="btn btn-sm btn-success">
                        Mark Done
                      </a>
                    <?php } else { ?>
                      Done
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="9">No consultation records found.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
</div>

</div>
<?php include('../footer.php'); ?>
</body>
</html>