<?php

include('../dbcon.php');

    if (isset($_POST['submit'])) {
        $immunization_id = $_POST['immunization_id'];
        $patientid = $_POST['patientid'];
        $reg_date = $_POST['reg_date'];
        $se_status = $_POST['se_status'];
        $cpab1 = isset($_POST['cpab1']) ? $_POST['cpab1'] : '';
        $cpab2 = isset($_POST['cpab2']) ? $_POST['cpab2'] : '';
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $birth_weight_status = $_POST['birth_weight_status'];
        $initiated_breastfeed = $_POST['initiated_breastfeed'];

    mysqli_query($con, "INSERT INTO immunization 
    (immunization_id, patientid, reg_date, se_status, cpab1, cpab2, length, weight, birth_weight_status, initiated_breastfeed)
    VALUES ('$immunization_id', '$patientid', '$reg_date', '$se_status', 
        '$cpab1', '$cpab2', '$length', '$weight', '$birth_weight_status', '$initiated_breastfeed')");

     header("Location: ".$_SERVER['HTTP_REFERER']);
    }
?>