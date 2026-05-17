<?php
include("../dbcon.php");

$did2 = $_GET['did2'];
mysqli_query($con, "DELETE FROM deworming WHERE deworming_id = '$did2'");
?>

<script type="text/javascript">
    window.location="../deworming2/deworming5-9.php";
</script> 

