<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $nutrition2_id = $_POST['nutrition2_id'];
    $patientid = $_POST['patientid'];
    $reg_date = $_POST['reg_date'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $age1 = isset($_POST['6to11mos']) ? $_POST['6to11mos'] : ''; // Check if 6to11mos checkbox is checked
    $age2 = isset($_POST['12to59mos']) ? $_POST['12to59mos'] : ''; // Check if 12to59mos checkbox is checked
    $vitamina = $_POST['vitamina'];
    $vitamin1 = $_POST['vitamin1'];
    $vitamin2 = $_POST['vitamin2'];
    $iron1 = $_POST['iron1'];
    $iron2 = $_POST['iron2'];
    $mnp1 = $_POST['mnp1'];
    $mnp2 = $_POST['mnp2'];
    $deworming = $_POST['deworming'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);
    $remarks1 = $_POST['remarks1'];
    $remarks1 = mysqli_real_escape_string($con, $remarks1);

    mysqli_query($con, "INSERT INTO nutrition2 VALUES ('$nutrition2_id', '$patientid', '$reg_date', 
    '$weight', '$height', '$age1', '$age2', '$vitamina', '$vitamin1', '$vitamin2', 
    '$iron1', '$iron2', '$mnp1', '$mnp2', '$deworming', '$remarks, $remarks1')") or die('Error: ' . mysqli_error($con));

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>