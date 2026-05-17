<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $maternal_id = $_POST['maternal_id'];
    $patientid = $_POST['patientid'];
    $reg_date = $_POST['reg_date'];
    $lmp = $_POST['lmp'];
    $g = $_POST['g'];
    $p = $_POST['p'];
    $edc = $_POST['edc'];
    $trimester1 = $_POST['trimester1'];
    $trimester1a = $_POST['trimester1a'];
    $trimester2 = $_POST['trimester2'];
    $trimester2a = $_POST['trimester2a'];
    $trimester3 = $_POST['trimester3'];
    $trimester3a = $_POST['trimester3a'];
    $tetanus_status = $_POST['tetanus_status'];
    $tt1date = $_POST['tt1date'];
    $tt2date = $_POST['tt2date'];
    $tt3date = $_POST['tt3date'];
    $tt4date = $_POST['tt4date'];
    $tt5date = $_POST['tt5date'];
    $iron1date = $_POST['iron1date'];
    $datenumber1st = $_POST['1datenumber'];
    $iron2date = $_POST['iron2date'];
    $datenumber2nd = $_POST['2datenumber'];
    $iron3date = $_POST['iron3date'];
    $datenumber3rd = $_POST['3datenumber'];
    $iron4date = $_POST['iron4date'];
    $datenumber4th = $_POST['4datenumber'];
    $iron5date = $_POST['iron5date'];
    $datenumber5th = $_POST['5datenumber'];
    $iron6date = $_POST['iron6date'];
    $datenumber6th = $_POST['6datenumber'];
    $sydate = $_POST['sydate'];
    $syresult = $_POST['syresult'];
    $syresult_date = $_POST['syresult_date'];
    $given_penicillin = $_POST['given_penicillin'];
    $given_penicillin_date = $_POST['given_penicillin_date'];
    $date_terminated = $_POST['date_terminated'];
    $outcome = $_POST['outcome'];
    $gender = $_POST['gender'];
    $birth_weight = $_POST['birth_weight'];
    $facility = $_POST['facility'];
    $nid = $_POST['nid'];
    $attended = $_POST['attended'];

    $maternaladd = mysqli_query($con, "INSERT INTO maternal 
    (maternal_id, patientid, reg_date, lmp, g, p, edc, 
    trimester1, trimester1a, trimester2, trimester2a, trimester3, trimester3a, tetanus_status, tt1date, tt2date, tt3date, tt4date, tt5date,
    iron1date, 1datenumber, iron2date, 2datenumber, iron3date, 3datenumber, 
    iron4date, 4datenumber, iron5date, 5datenumber, iron6date, 6datenumber, 
    sydate, syresult, syresult_date, given_penicillin, given_penicillin_date, date_terminated, outcome, gender,
    birth_weight, facility, nid, attended)
    VALUES ('$maternal_id', '$patientid', '$reg_date', '$lmp', '$g', '$p', '$edc', 
    '$trimester1', '$trimester1a', '$trimester2', '$trimester2a', '$trimester3', '$trimester3a', 
    '$tetanus_status', '$tt1date', '$tt2date', '$tt3date', '$tt4date', '$tt5date',
    '$iron1date', '$datenumber1st', '$iron2date', '$datenumber2nd', '$iron3date', '$datenumber3rd', 
    '$iron4date', '$datenumber4th', '$iron5date', '$datenumber5th', '$iron6date', '$datenumber6th', 
    '$sydate', '$syresult', '$syresult_date', '$given_penicillin', '$given_penicillin_date', '$date_terminated', '$outcome', '$gender',
    '$birth_weight', '$facility', '$nid', '$attended')") or die('Error: ' . mysqli_error($con));

    header("Location: " . $_SERVER['HTTP_REFERER']);

}
?>