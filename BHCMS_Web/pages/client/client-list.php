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

if(isset($_POST['save_client'])){
  $client = [
    "bims_resident_id" => intval($_POST['bims_resident_id']),
    "fname" => $_POST['fname'],
    "mname" => $_POST['mname'],
    "surname" => $_POST['surname'],
    "sex" => $_POST['sex'],
    "bday" => $_POST['bday'],
    "purok" => $_POST['purok']
  ];

  $savedClient = api_request("POST", "/Clients", $client);

  if($savedClient && isset($savedClient['client_id'])){
    $consult = [
      "client_id" => intval($savedClient['client_id']),
      "concern" => $_POST['concern'],
      "medicine_given" => ""
    ];

    api_request("POST", "/GeneralConsultations", $consult);
    $message = "Client added successfully.";
  } else {
    $message = "API offline. Cannot save client.";
    $apiOnline = false;
  }
}

if(isset($_POST['save_consult'])){
  $consult = [
    "client_id" => intval($_POST['client_id']),
    "concern" => $_POST['consult_concern'],
    "medicine_given" => $_POST['medicine_given']
  ];

  $saved = api_request("POST", "/GeneralConsultations", $consult);
  $message = $saved ? "Consultation added successfully." : "API offline. Cannot save consultation.";
}

if(isset($_POST['edit_client'])){
  $id = intval($_POST['client_id']);

  $client = [
    "fname" => $_POST['fname'],
    "mname" => $_POST['mname'],
    "surname" => $_POST['surname'],
    "sex" => $_POST['sex'],
    "bday" => $_POST['bday'],
    "purok" => $_POST['purok']
  ];

  $updated = api_request("PUT", "/Clients/".$id, $client);
  $message = $updated ? "Client updated successfully." : "API offline. Cannot update client.";
}

$clients = api_request("GET", "/Clients");
if(!is_array($clients)){
  $clients = [];
  $apiOnline = false;
}

$consultations = api_request("GET", "/GeneralConsultations");
if(!is_array($consultations)){
  $consultations = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../headsidecss.php'); ?>
  <title>Client List</title>
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
      <h4 class="font-weight-bold" style="font-size:40px;font-family:'Poppins',sans-serif">ALL CLIENTS</h4>
      <button class="btn btn-primary" data-toggle="modal" data-target="#addClientModal">
        <i class="fas fa-plus"></i> Add Client
      </button>
    </div>
  </div>

  <section class="content text-sm">
    <div class="container-fluid">

      <?php if($message!=""){ ?><div class="alert alert-info"><?php echo $message; ?></div><?php } ?>
      <?php if(!$apiOnline){ ?><div class="alert alert-danger">API server is offline. Data cannot be loaded.</div><?php } ?>

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
                <th>Initial Concern</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php if(count($clients)>0){ ?>
                <?php foreach($clients as $c){ 
                  
                  $latestConcern = "";

                  foreach($consultations as $gc){
                  if($gc['client_id'] == $c['client_id']){
                    $latestConcern = $gc['concern'];
                  break;
                  }
                  }
                ?>
                
                <tr>
                  <td><?php echo $c['client_id']; ?></td>
                  <td><?php echo $c['fname']." ".$c['mname']." ".$c['surname']; ?></td>
                  <td><?php echo $c['bday']; ?></td>
                  <td><?php echo $c['sex']; ?></td>
                  <td><?php echo $c['purok']; ?></td>
                  <td><?php echo htmlspecialchars($latestConcern); ?></td>
                  <td>
                    <a href="client-record.php?id=<?php echo $c['client_id']; ?>" class="btn btn-info btn-sm">
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

                        <label>First Name</label>
                        <input name="fname" class="form-control mb-2" value="<?php echo $c['fname']; ?>">

                        <label>Middle Name</label>
                        <input name="mname" class="form-control mb-2" value="<?php echo $c['mname']; ?>">

                        <label>Surname</label>
                        <input name="surname" class="form-control mb-2" value="<?php echo $c['surname']; ?>">

                        <label>Sex</label>
                        <input name="sex" class="form-control mb-2" value="<?php echo $c['sex']; ?>">

                        <label>Birthdate</label>
                        <input name="bday" class="form-control mb-2" value="<?php echo $c['bday']; ?>">

                        <label>Purok</label>
                        <input name="purok" class="form-control mb-2" value="<?php echo $c['purok']; ?>">
                      </div>

                      <div class="modal-footer">
                        <button type="submit" name="edit_client" class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="6">No clients found.</td>
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

<div class="modal fade" id="addClientModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h5 class="modal-title">Add Client from BIMS</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <div class="form-group">
          <label>Search Resident from BIMS</label>
          <input type="text" id="residentSearch" class="form-control" placeholder="Type resident name...">
        </div>

        <div id="suggestions" class="list-group mb-3"></div>

        <form method="post">
          <input type="hidden" name="bims_resident_id" id="bims_id">

          <div class="row">
            <div class="col-md-4">
              <label>First Name</label>
              <input name="fname" id="fname" class="form-control mb-2" readonly required>
            </div>

            <div class="col-md-4">
              <label>Middle Name</label>
              <input name="mname" id="mname" class="form-control mb-2" readonly>
            </div>

            <div class="col-md-4">
              <label>Surname</label>
              <input name="surname" id="surname" class="form-control mb-2" readonly required>
            </div>

            <div class="col-md-4">
              <label>Sex</label>
              <input name="sex" id="sex" class="form-control mb-2" readonly>
            </div>

            <div class="col-md-4">
              <label>Birthdate</label>
              <input name="bday" id="bday" class="form-control mb-2" readonly>
            </div>

            <div class="col-md-4">
              <label>Purok</label>
              <input name="purok" id="purok" class="form-control mb-2" readonly>
            </div>
          </div>

          <label>Initial Concern</label>
          <textarea name="concern" class="form-control mb-3" required></textarea>

          <button type="submit" name="save_client" class="btn btn-success">
            Save Client
          </button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
function selectResident(id, fname, mname, surname, sex, bday, purok){
  document.getElementById('bims_id').value = id;
  document.getElementById('fname').value = fname;
  document.getElementById('mname').value = mname;
  document.getElementById('surname').value = surname;
  document.getElementById('sex').value = sex;
  document.getElementById('bday').value = bday;
  document.getElementById('purok').value = purok;

  document.getElementById('residentSearch').value = fname + " " + mname + " " + surname;
  document.getElementById('suggestions').innerHTML = "";
}

document.getElementById('residentSearch').addEventListener('keyup', function(){
  let q = this.value;

  if(q.length < 2){
    document.getElementById('suggestions').innerHTML = "";
    return;
  }

  fetch("search-bims-api.php?q=" + encodeURIComponent(q))
  .then(response => response.json())
  .then(data => {
    let box = document.getElementById('suggestions');
    box.innerHTML = "";

    if(data.length === 0){
      box.innerHTML = "<div class='list-group-item'>No resident found</div>";
      return;
    }

    data.forEach(r => {
      let name = r.fname + " " + (r.mname ?? "") + " " + r.surname;
      let item = document.createElement("button");

      item.type = "button";
      item.className = "list-group-item list-group-item-action";
      item.innerHTML = name + " - " + (r.purok ?? "");

      item.onclick = function(){
        selectResident(
          r.id,
          r.fname ?? "",
          r.mname ?? "",
          r.surname ?? "",
          r.sex ?? "",
          r.bday ?? "",
          r.purok ?? ""
        );
      };

      box.appendChild(item);
    });
  })
  .catch(() => {
    document.getElementById('suggestions').innerHTML =
    "<div class='list-group-item text-danger'>API server is offline</div>";
  });
});
</script>

<?php include('../footer.php'); ?>
</body>
</html>