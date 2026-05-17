<?php

include('../dbcon.php');

if (isset($_POST['submit1'])) {
    $rem_tri1 = $_POST['rem_tri1'];
    $rem_tri1 = mysqli_real_escape_string($con, $rem_tri1);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri1 = '$rem_tri1' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['submit2'])) {
    $rem_tri2 = $_POST['rem_tri2'];
    $rem_tri2 = mysqli_real_escape_string($con, $rem_tri2);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri2 = '$rem_tri2' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['submit3'])) {
    $rem_tri3 = $_POST['rem_tri3'];
    $rem_tri3 = mysqli_real_escape_string($con, $rem_tri3);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri3 = '$rem_tri3' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['submit4'])) {
    $rem_tri1a = $_POST['rem_tri1a'];
    $rem_tri1a = mysqli_real_escape_string($con, $rem_tri1a);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri1a = '$rem_tri1a' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['submit5'])) {
    $rem_tri2a = $_POST['rem_tri2a'];
    $rem_tri2a = mysqli_real_escape_string($con, $rem_tri2a);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri2a = '$rem_tri2a' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['submit6'])) {
    $rem_tri3a = $_POST['rem_tri3a'];
    $rem_tri3a = mysqli_real_escape_string($con, $rem_tri3a);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE maternal set rem_tri3a = '$rem_tri3a' WHERE maternal_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>


