<?php

include('../dbcon.php');

if (isset($_POST['submit1'])) {
    $remarks_1stdose = $_POST['remarks_1stdose'];
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE deworming set remarks_1stdose = '$remarks_1stdose' WHERE deworming_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}


if (isset($_POST['submit2'])) {
    $remarks_2nddose = $_POST['remarks_2nddose'];
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE deworming set remarks_2nddose = '$remarks_2nddose' WHERE deworming_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
