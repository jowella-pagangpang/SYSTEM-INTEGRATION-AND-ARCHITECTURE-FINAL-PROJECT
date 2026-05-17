<?php

include('../dbcon.php');


if (isset($_POST['submit'])) {
    $consult_id = $_POST['consult_id'];
    $patientid = $_POST['patientid'];
    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    mysqli_query($con, "INSERT INTO consultation VALUES ('$consult_id', '$patientid', '$date', '$weight', '$height', '$diagnosis', '$treatment', '$remarks')"); ?>

<script type="text/javascript">
    window.location = "deworming.php";
</script>

<?php
}

?>

