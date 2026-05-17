<?php
include("../dbcon.php");

$nid1 = $_GET['nid1'];
mysqli_query($con, "DELETE FROM nutrition1 WHERE nutrition1_id = '$nid1'");
?>

<script type="text/javascript">
    window.location="../nutrition1/nutrition1.php";
</script> 

