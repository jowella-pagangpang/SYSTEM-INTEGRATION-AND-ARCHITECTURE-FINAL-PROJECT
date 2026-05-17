<?php

include('../dbcon.php');


if (isset($_POST['submit'])) {
    $deworming_id = $_POST['deworming_id'];
    $patientid = $_POST['patientid'];
    $reg_date = $_POST['reg_date'];
    $first = $_POST['1stdose'];
    $second = $_POST['2nddose'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    mysqli_query($con, "INSERT INTO deworming
     (deworming_id, patientid, reg_date, 1stdose, 2nddose, remarks) 
     VALUES ('$deworming_id', '$patientid', '$reg_date', '$first', '$second', '$remarks')");

    header("Location: " . $_SERVER['HTTP_REFERER']);
}


?>

