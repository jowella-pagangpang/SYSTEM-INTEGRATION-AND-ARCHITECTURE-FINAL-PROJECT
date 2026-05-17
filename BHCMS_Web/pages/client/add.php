
<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $minitial = $_POST['minitial'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth_date'];
    $sex = $_POST['sex'];
    $mother_name = $_POST['mother_name'];
    $purok = $_POST['purok'];
    $address = $_POST['address'];

    mysqli_query($con, "INSERT INTO client
     VALUES ('$id', '$fname', '$minitial', '$lname', '$birth_date', '$sex', '$mother_name', '$purok', '$address')"); 

    header("Location: ".$_SERVER['HTTP_REFERER']);

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
