<?php
include('../dbcon.php');
session_start();

if(!isset($_SESSION['type'])){
  header("Location: ../../index.php");
  exit();
}

$message = "";

if(isset($_POST['save'])){
  $bims_id = $_POST['bims_resident_id'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $surname = $_POST['surname'];
  $sex = $_POST['sex'];
  $bday = $_POST['bday'];
  $purok = $_POST['purok'];
  $concern = $_POST['concern'];

  $check = mysqli_query($con, "SELECT client_id FROM clients WHERE bims_resident_id='$bims_id'");
  if(mysqli_num_rows($check) > 0){
    $row = mysqli_fetch_assoc($check);
    $client_id = $row['client_id'];
  } else {
    mysqli_query($con, "INSERT INTO clients(bims_resident_id,fname,mname,surname,sex,bday,purok)
    VALUES('$bims_id','$fname','$mname','$surname','$sex','$bday','$purok')");
    $client_id = mysqli_insert_id($con);
  }

  mysqli_query($con, "INSERT INTO general_consultations(client_id, concern, action_status)
  VALUES('$client_id','$concern','Pending')");

  $message = "Consultation added successfully.";
}

if(isset($_GET['done'])){
  $id = $_GET['done'];
  mysqli_query($con, "UPDATE general_consultations SET action_status='Done' WHERE consult_id='$id'");
  $message = "Consultation marked as done.";
}

$consultations = mysqli_query($con, "SELECT gc.consult_id, gc.concern, gc.action_status, gc.date_added,
c.fname, c.mname, c.surname, c.sex, c.bday, c.purok
FROM general_consultations gc
INNER JOIN clients c ON gc.client_id = c.client_id
ORDER BY gc.consult_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../headsidecss.php'); ?>
  <title>General Consultation</title>
  <link rel="icon" href="../../img/logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
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
          <a href="../general-consult/general-consult.php" class="nav-link active">
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
      <h4 class="font-weight-bold" style="font-size:40px; font-family:'Poppins',sans-serif">GENERAL CONSULTATIONS</h4>
    </div>
  </div>

  <section class="content text-sm">
    <div class="container-fluid">

      <?php if($message!=""){ ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
      <?php } ?>

      <?php if(isset($_GET['id'])){ ?>
      <div class="card">
        <div class="card-header bg-primary">
          <b>Add Consultation</b>
        </div>

        <div class="card-body">
          <form method="post">
            <input type="hidden" name="bims_resident_id" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="fname" value="<?php echo $_GET['fname']; ?>">
            <input type="hidden" name="mname" value="<?php echo $_GET['mname']; ?>">
            <input type="hidden" name="surname" value="<?php echo $_GET['surname']; ?>">
            <input type="hidden" name="sex" value="<?php echo $_GET['sex']; ?>">
            <input type="hidden" name="bday" value="<?php echo $_GET['bday']; ?>">
            <input type="hidden" name="purok" value="<?php echo $_GET['purok']; ?>">

            <div class="form-group">
              <label>Client Name</label>
              <input type="text" class="form-control" readonly
              value="<?php echo $_GET['fname'].' '.$_GET['mname'].' '.$_GET['surname']; ?>">
            </div>

            <div class="form-group">
              <label>Concern / Purpose</label>
              <textarea name="concern" class="form-control" required placeholder="Enter client concern"></textarea>
            </div>

            <button type="submit" name="save" class="btn btn-success">
              Save as Pending
            </button>
          </form>
        </div>
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
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php while($row = mysqli_fetch_assoc($consultations)){ ?>
              <tr>
                <td><?php echo $row['date_added']; ?></td>
                <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['surname']; ?></td>
                <td><?php echo $row['sex']; ?></td>
                <td><?php echo $row['bday']; ?></td>
                <td><?php echo $row['purok']; ?></td>
                <td><?php echo $row['concern']; ?></td>
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