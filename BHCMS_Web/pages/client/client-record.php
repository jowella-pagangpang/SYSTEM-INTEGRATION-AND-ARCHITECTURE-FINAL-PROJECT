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

  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<div class="content-wrapper" style="margin-left:0; font-family: Helvetica;">
  <div class="content-header no-print">
    <div class="container-fluid d-flex justify-content-between">
      <h4 class="font-weight-bold">CLIENT RECORD</h4>

      <div>
        <button onclick="window.print()" class="btn btn-primary btn-sm">
          <i class="fas fa-print"></i> Print
        </button>

        <a href="client-list.php" class="btn btn-dark btn-sm">
          <i class="fas fa-times"></i>
        </a>
      </div>
    </div>
  </div>

  <section class="content text-sm">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">

          <h4 class="font-weight-bold text-center">Barangay Health Center Client Record</h4>
          <hr>

          <h5 class="font-weight-bold">
            <?php echo $c['fname'].' '.$c['mname'].' '.$c['surname']; ?>
          </h5>

          <div class="row mt-3">
            <div class="col-md-3">
              <b>Client ID:</b><br>
              <?php echo $c['client_id']; ?>
            </div>

            <div class="col-md-3">
              <b>BIMS Resident ID:</b><br>
              <?php echo $c['bims_resident_id']; ?>
            </div>

            <div class="col-md-3">
              <b>Birthdate:</b><br>
              <?php echo $c['bday']; ?>
            </div>

            <div class="col-md-3">
              <b>Sex:</b><br>
              <?php echo $c['sex']; ?>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <b>Purok:</b><br>
              <?php echo $c['purok']; ?>
            </div>

            <div class="col-md-6">
              <b>Date Added:</b><br>
              <?php echo $c['date_added']; ?>
            </div>
          </div>

          <hr>

          <h5 class="font-weight-bold">Consultation History</h5>

          <table class="table table-bordered table-hover text-center">
            <thead>
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
  </section>
</div>

</div>
</body>
</html>