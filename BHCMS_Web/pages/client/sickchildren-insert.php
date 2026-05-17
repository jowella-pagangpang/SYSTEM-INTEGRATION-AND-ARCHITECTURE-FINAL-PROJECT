<?php

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $sick_children_id = $_POST['sick_children_id'];
    $patientid = $_POST['patientid'];
    $reg_date = $_POST['reg_date'];
    $se_status = $_POST['se_status'];
    $vitamin_6to11mos = $_POST['vitamin_6to11mos'];
    $vitamin_12to59mos = $_POST['vitamin_12to59mos'];
    $diagnosis = $_POST['diagnosis'];
    $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
    $remarks1 = $_POST['remarks1'];
    $remarks1 = mysqli_real_escape_string($con, $remarks1);
    $diarrhea_age = $_POST['diarrhea_age'];
    $diarrhea_ors_date = $_POST['diarrhea_ors_date'];
    $diarrhea_oralzinc_date = $_POST['diarrhea_oralzinc_date'];
    $remarks2 = $_POST['remarks2'];
    $remarks2 = mysqli_real_escape_string($con, $remarks2);
    $pneumonia_age = $_POST['pneumonia_age'];
    $pneumonia_treatment_date = $_POST['pneumonia_treatment_date'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    mysqli_query($con, "INSERT INTO sickchildren
    VALUES ('$sick_children_id', '$patientid', '$reg_date', '$se_status', '$vitamin_6to11mos', 
    '$vitamin_12to59mos', '$diagnosis', '$vitamin_supplementation_date', '$remarks1', '$diarrhea_age', '$diarrhea_ors_date', 
    '$diarrhea_oralzinc_date', '$remarks2', '$pneumonia_age', '$pneumonia_treatment_date', '$remarks')");


    header("Location: " . $_SERVER['HTTP_REFERER']);

}
?>