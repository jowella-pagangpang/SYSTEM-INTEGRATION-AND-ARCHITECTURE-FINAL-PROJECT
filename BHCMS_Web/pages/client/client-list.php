<?php
include('../dbcon.php');
session_start();

if(!isset($_SESSION['type'])){
  header("Location: ../../index.php");
  exit();
}

$API_BASE = "https://localhost:44315/api";
$API_KEY = "bims-secret-key-2024";
$message = "";
$apiResults = [];
$apiOnline = true;

function api_get($url, $key){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-API-KEY: $key"]);
  $res = curl_exec($ch);
  $err = curl_error($ch);
  curl_close($ch);
  if($err || !$res) return null;
  return json_decode($res, true);
}

if(isset($_GET['search_bims'])){
  $q = $_GET['q'];
  $apiResults = api_get($API_BASE."/Residents/search?q=".urlencode($q), $API_KEY);
  if(!is_array($apiResults)){
    $apiOnline = false;
    $apiResults = [];
  }
}

if(isset($_POST['save_client'])){
  $bims_id = mysqli_real_escape_string($con, $_POST['bims_resident_id']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $mname = mysqli_real_escape_string($con, $_POST['mname']);
  $surname = mysqli_real_escape_string($con, $_POST['surname']);
  $sex = mysqli_real_escape_string($con, $_POST['sex']);
  $bday = mysqli_real_escape_string($con, $_POST['bday']);
  $purok = mysqli_real_escape_string($con, $_POST['purok']);
  $concern = mysqli_real_escape_string($con, $_POST['concern']);

  $check = mysqli_query($con, "SELECT client_id FROM clients WHERE bims_resident_id='$bims_id'");
  if(mysqli_num_rows($check) > 0){
    $row = mysqli_fetch_assoc($check);
    $client_id = $row['client_id'];
  } else {
    mysqli_query($con, "INSERT INTO clients(bims_resident_id,fname,mname,surname,sex,bday,purok)
    VALUES('$bims_id','$fname','$mname','$surname','$sex','$bday','$purok')");
    $client_id = mysqli_insert_id($con);
  }

  mysqli_query($con, "INSERT INTO general_consultations(client_id, concern, medicine_given, action_status)
  VALUES('$client_id','$concern','','Pending')");
  $message = "Client added successfully.";
}

if(isset($_POST['save_consult'])){
  $client_id = mysqli_real_escape_string($con, $_POST['client_id']);
  $concern = mysqli_real_escape_string($con, $_POST['consult_concern']);
  $medicine = mysqli_real_escape_string($con, $_POST['medicine_given']);

  mysqli_query($con, "INSERT INTO general_consultations(client_id, concern, medicine_given, action_status)
  VALUES('$client_id','$concern','$medicine','Pending')");
  $message = "Consultation added successfully.";
}

if(isset($_POST['edit_client'])){
  $client_id = mysqli_real_escape_string($con, $_POST['client_id']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $mname = mysqli_real_escape_string($con, $_POST['mname']);
  $surname = mysqli_real_escape_string($con, $_POST['surname']);
  $sex = mysqli_real_escape_string($con, $_POST['sex']);
  $bday = mysqli_real_escape_string($con, $_POST['bday']);
  $purok = mysqli_real_escape_string($con, $_POST['purok']);

  mysqli_query($con, "UPDATE clients SET fname='$fname', mname='$mname', surname='$surname',
  sex='$sex', bday='$bday', purok='$purok' WHERE client_id='$client_id'");
  $message = "Client updated successfully.";
}

$clients = mysqli_query($con, "SELECT * FROM clients ORDER BY client_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../headsidecss.php'); ?>
  <title>Client List</title>
  <link rel="icon" href="../../img/logo.png">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
  <h1 class="brand-link text-center">
    <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">Health Record Management</span>
  </h1>

  <div class="sidebar">
    <div class="user-panel pb-3 mb-3 text-center">
      <img src="../../img/basak logo.png" style="height:40%; width:40%;">
    </div>

    <nav class="mt-2" style="font-family: Helvetica;">
      <ul class="nav nav-pills nav-sidebar flex-column text-sm">
        <li class="nav-item"><a href="../main/dashboard.php" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a></li>
        <li class="nav-item"><a href="../client/client-list.php" class="nav-link active"><i class="nav-icon fas fa-users"></i><p>All Clients</p></a></li>
        <li class="nav-item"><a href="../client/general-consult.php" class="nav-link"><i class="nav-icon fas fa-notes-medical"></i><p>General Consultations</p></a></li>
        <li class="nav-item"><a href="../../index.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
      </ul>
    </nav>
  </div>
</aside>

<div class="content-wrapper" style="font-family: Helvetica;">
  <div class="content-header">
    <div class="container-fluid d-flex justify-content-between">
      <h4 class="font-weight-bold">ALL CLIENTS</h4>
      <button class="btn btn-primary" data-toggle="modal" data-target="#addClientModal">
        <i class="fas fa-plus"></i> Add Client
      </button>
    </div>
  </div>

  <section class="content text-sm">
    <div class="container-fluid">

      <?php if($message!=""){ ?><div class="alert alert-success"><?php echo $message; ?></div><?php } ?>
      <?php if(!$apiOnline){ ?><div class="alert alert-danger">API server is offline. Cannot search resident from BIMS.</div><?php } ?>

      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-hover text-center">
            <thead class="bg-lightblue">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Sex</th>
                <th>Purok</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($c = mysqli_fetch_assoc($clients)){ ?>
              <tr>
                <td><?php echo $c['client_id']; ?></td>
                <td><?php echo $c['fname']." ".$c['mname']." ".$c['surname']; ?></td>
                <td><?php echo $c['bday']; ?></td>
                <td><?php echo $c['sex']; ?></td>
                <td><?php echo $c['purok']; ?></td>
                <td>
                    <a href="client-record.php?id=<?php echo $c['client_id']; ?>" class="btn btn-info btn-sm" title="View Record">
                        <i class="fas fa-file-medical"></i>
                    </a>

                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#consultModal<?php echo $c['client_id']; ?>">
                        Consultation
                    </button>

                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $c['client_id']; ?>">
                        Edit
                    </button>
                </td>
              </tr>

              <div class="modal fade" id="consultModal<?php echo $c['client_id']; ?>">
                <div class="modal-dialog">
                  <form method="post" class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title">Add Consultation</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="client_id" value="<?php echo $c['client_id']; ?>">
                      <label>Client Name</label>
                      <input class="form-control mb-2" readonly value="<?php echo $c['fname'].' '.$c['mname'].' '.$c['surname']; ?>">
                      <label>Consultation Concern</label>
                      <textarea name="consult_concern" class="form-control mb-2" required></textarea>
                      <label>Medicine / Action Taken</label>
                      <textarea name="medicine_given" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="save_consult" class="btn btn-success">Save Consultation</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="modal fade" id="editModal<?php echo $c['client_id']; ?>">
                <div class="modal-dialog">
                  <form method="post" class="modal-content">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title">Edit Client</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="client_id" value="<?php echo $c['client_id']; ?>">
                      <input name="fname" class="form-control mb-2" value="<?php echo $c['fname']; ?>">
                      <input name="mname" class="form-control mb-2" value="<?php echo $c['mname']; ?>">
                      <input name="surname" class="form-control mb-2" value="<?php echo $c['surname']; ?>">
                      <input name="sex" class="form-control mb-2" value="<?php echo $c['sex']; ?>">
                      <input name="bday" class="form-control mb-2" value="<?php echo $c['bday']; ?>">
                      <input name="purok" class="form-control mb-2" value="<?php echo $c['purok']; ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="edit_client" class="btn btn-warning">Update</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
</div>
</div>

<div class="modal fade" id="addClientModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add Client from BIMS</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form method="get" class="mb-3">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search resident name">
            <div class="input-group-append">
              <button name="search_bims" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>

        <?php if(count($apiResults)>0){ ?>
        <table class="table table-bordered text-center">
          <tr>
            <th>Name</th>
            <th>Sex</th>
            <th>Birthdate</th>
            <th>Purok</th>
            <th>Select</th>
          </tr>
          <?php foreach($apiResults as $r){ ?>
          <tr>
            <td><?php echo $r['fname']." ".$r['mname']." ".$r['surname']; ?></td>
            <td><?php echo $r['sex']; ?></td>
            <td><?php echo $r['bday']; ?></td>
            <td><?php echo $r['purok']; ?></td>
            <td>
              <button type="button" class="btn btn-info btn-sm"
              onclick="selectResident('<?php echo $r['id']; ?>','<?php echo $r['fname']; ?>','<?php echo $r['mname']; ?>','<?php echo $r['surname']; ?>','<?php echo $r['sex']; ?>','<?php echo $r['bday']; ?>','<?php echo $r['purok']; ?>')">
                Select
              </button>
            </td>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>

        <form method="post">
          <input type="hidden" name="bims_resident_id" id="bims_id">
          <div class="row">
            <div class="col-md-4"><input name="fname" id="fname" class="form-control mb-2" placeholder="First Name" readonly></div>
            <div class="col-md-4"><input name="mname" id="mname" class="form-control mb-2" placeholder="Middle Name" readonly></div>
            <div class="col-md-4"><input name="surname" id="surname" class="form-control mb-2" placeholder="Surname" readonly></div>
            <div class="col-md-4"><input name="sex" id="sex" class="form-control mb-2" placeholder="Sex" readonly></div>
            <div class="col-md-4"><input name="bday" id="bday" class="form-control mb-2" placeholder="Birthdate" readonly></div>
            <div class="col-md-4"><input name="purok" id="purok" class="form-control mb-2" placeholder="Purok" readonly></div>
          </div>

          <label>Client Concern</label>
          <textarea name="concern" class="form-control mb-3" required></textarea>

          <button type="submit" name="save_client" class="btn btn-success">Save Client</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function selectResident(id,fname,mname,surname,sex,bday,purok){
  document.getElementById('bims_id').value=id;
  document.getElementById('fname').value=fname;
  document.getElementById('mname').value=mname;
  document.getElementById('surname').value=surname;
  document.getElementById('sex').value=sex;
  document.getElementById('bday').value=bday;
  document.getElementById('purok').value=purok;
}
</script>

<?php include('../footer.php'); ?>
</body>
</html>