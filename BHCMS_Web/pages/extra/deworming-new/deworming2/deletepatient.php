<?php
include("../dbcon.php");

$did2 = $_GET['did2'];
mysqli_query($con, "DELETE FROM deworming2 WHERE deworming2_id = '$did2'");
?>

<script type="text/javascript">
    window.location="../deworming2/deworming5-9.php";
</script> 

