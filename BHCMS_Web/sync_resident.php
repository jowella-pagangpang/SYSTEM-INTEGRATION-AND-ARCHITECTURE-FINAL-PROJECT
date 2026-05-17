<?php
include('pages/dbcon.php');

$api_key     = isset($_POST['api_key']) ? $_POST['api_key'] : '';
$resident_id = isset($_POST['resident_id']) ? $_POST['resident_id'] : null;
$fname       = isset($_POST['fname']) ? $_POST['fname'] : '';
$mname       = isset($_POST['mname']) ? $_POST['mname'] : '';
$surname     = isset($_POST['surname']) ? $_POST['surname'] : '';
$sex         = isset($_POST['sex']) ? $_POST['sex'] : '';
$purok       = isset($_POST['purok']) ? $_POST['purok'] : '';

// ✅ Convert bday format
$bday_raw = isset($_POST['bday']) ? $_POST['bday'] : '';
$bday = '';
if (!empty($bday_raw)) {
    $date = date_create($bday_raw);
    if ($date) {
        $bday = date_format($date, 'Y-m-d');
    } else {
        $bday = $bday_raw;
    }
}

if (!$resident_id) {
    echo json_encode(['error' => 'Missing resident_id']);
    exit;
}

$fname   = mysqli_real_escape_string($con, $fname);
$mname   = mysqli_real_escape_string($con, $mname);
$surname = mysqli_real_escape_string($con, $surname);
$bday    = mysqli_real_escape_string($con, $bday);

$check = mysqli_query($con,
    "SELECT id FROM client 
     WHERE fname='$fname' AND lname='$surname'
     LIMIT 1"
);

if (mysqli_num_rows($check) > 0) {
    $client    = mysqli_fetch_assoc($check);
    $client_id = $client['id'];

    $sex_mapped = ($sex === 'Male' || $sex === 'male') ? 'M' : 'F';

    $update = mysqli_query($con,
        "UPDATE client SET 
            fname='$fname',
            minitial='$mname',
            lname='$surname',
            birth_date='$bday',
            sex='$sex_mapped'
         WHERE id='$client_id'"
    );

    if ($update) {
        echo json_encode(['status' => 'updated', 'client_id' => $client_id, 'bday' => $bday]);
    } else {
        echo json_encode(['status' => 'update_failed', 'error' => mysqli_error($con)]);
    }
} else {
    echo json_encode(['status' => 'not_found']);
}