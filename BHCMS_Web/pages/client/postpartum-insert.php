<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $postpartum_id = $_POST['postpartum_id'];
    $patientid = $_POST['patientid'];
    $delivery_date = $_POST['delivery_date'];
    $delivery_time = $_POST['delivery_time'];
    $date_visit_24hr = $_POST['date_visit_24hr'];
    $date_visit_1week = $_POST['date_visit_1week'];
    $date_breastfeed = $_POST['date_breastfeed'];
    $time_breastfeed = $_POST['time_breastfeed'];
    $iron_supplementation_1stdate = $_POST['iron_supplementation_1stdate'];
    $firstdate_tablets = $_POST['1stdate_tablets'];
    $iron_supplementation_2nddate = $_POST['iron_supplementation_2nddate'];
    $seconddate_tablets = $_POST['2nddate_tablets'];
    $iron_supplementation_3rddate = $_POST['iron_supplementation_3rddate'];
    $thirddate_tablets = $_POST['3rddate_tablets'];
    $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    mysqli_query($con, "INSERT INTO postpartum
        (postpartum_id, patientid, delivery_date, delivery_time, date_visit_24hr, date_visit_1week, 
        date_breastfeed, time_breastfeed, iron_supplementation_1stdate, 1stdate_tablets, iron_supplementation_2nddate, 
        2nddate_tablets, iron_supplementation_3rddate, 3rddate_tablets, vitamin_supplementation_date, remarks)
        VALUES ('$postpartum_id', '$patientid', '$delivery_date', '$delivery_time', '$date_visit_24hr', '$date_visit_1week', '$date_breastfeed', '$time_breastfeed', 
        '$iron_supplementation_1stdate', '$firstdate_tablets', '$iron_supplementation_2nddate', '$seconddate_tablets', 
        '$iron_supplementation_3rddate', '$thirddate_tablets', '$vitamin_supplementation_date', '$remarks')") 
        or die('Error: ' . mysqli_error($con));


    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>p