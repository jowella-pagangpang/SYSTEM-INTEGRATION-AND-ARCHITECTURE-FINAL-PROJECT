
<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $bims_resident_id = $_POST['bims_resident_id'];
    $fname = $_POST['fname'];
    $minitial = $_POST['minitial'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth_date'];
    $sex = $_POST['sex'];
    $mother_name = $_POST['mother_name'];
    $purok = $_POST['purok'];
    $address = $_POST['address'];

    if (empty($bims_resident_id)) {
        die("Error: Please select a resident from BIMS first.");
    }

    $checkResident = mysqli_query($con, "SELECT id FROM client WHERE bims_resident_id = '$bims_resident_id'");

    if (mysqli_num_rows($checkResident) > 0) {
        die("Error: This BIMS resident is already registered as a client.");
    }

    $insert = mysqli_query($con, "INSERT INTO client
    (id, bims_resident_id, fname, minitial, lname, birth_date, sex, mother_name, purok, address)
    VALUES
    ('$id', '$bims_resident_id', '$fname', '$minitial', '$lname', '$birth_date', '$sex', '$mother_name', '$purok', '$address')");

    if (!$insert) {
        die("Insert Error: " . mysqli_error($con));
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if (isset($_POST['update'])) {
    $id          = $_POST['id'];
    $fname       = $_POST['fname'];
    $minitial    = $_POST['minitial'];
    $lname       = $_POST['lname'];
    $birth_date  = $_POST['birth_date'];
    $sex         = $_POST['sex'];
    $mother_name = $_POST['mother_name'];
    $purok       = $_POST['purok'];
    $address     = $_POST['address'];

    // ✅ Update sa HRMS database
    mysqli_query($con, "UPDATE client SET 
        fname='$fname', 
        minitial='$minitial', 
        lname='$lname', 
        birth_date='$birth_date', 
        sex='$sex', 
        mother_name='$mother_name', 
        purok='$purok', 
        address='$address' 
        WHERE id = '$id'");

    // ✅ Sync to BIMS — find matching resident sa BIMS DB
    syncToBIMS($fname, $minitial, $lname, $birth_date, $sex, $purok);

    header("Location: client-list.php");
    exit;
}

// ✅ Sync function — mag-call sa BIMS API PUT endpoint
function syncToBIMS($fname, $mname, $lname, $birth_date, $sex, $purok) {
    $apiUrl = "https://localhost:44315/api/Residents/sync";
    $apiKey = "bims-secret-key-2024";

    // Map sex: M→Male, F→Female    
    $sex_mapped = ($sex === 'M') ? 'Male' : 'Female';

    $data = json_encode([
        'fname'    => $fname,
        'mname'    => $mname,
        'surname'  => $lname,
        'bday'     => $birth_date,
        'sex'      => $sex_mapped,
        'purok'    => $purok,
    ]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "X-API-KEY: " . $apiKey
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

?>
