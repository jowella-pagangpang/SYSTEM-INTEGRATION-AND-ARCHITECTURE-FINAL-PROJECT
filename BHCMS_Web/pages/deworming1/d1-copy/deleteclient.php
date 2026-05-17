<?php
include("../dbcon.php");

$did1 = $_GET['did1'];
mysqli_query($con, "DELETE FROM deworming WHERE deworming_id = '$did1'");
?>

<script type="text/javascript">
    window.location="../deworming1/deworming1-4.php";
</script> 

