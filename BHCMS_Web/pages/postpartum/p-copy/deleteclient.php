<?php
include("../dbcon.php");

$pid = $_GET['pid'];
mysqli_query($con, "DELETE FROM postpartum WHERE postpartum_id = '$pid'");
?>

<script type="text/javascript">
    window.location="../postpartum/postpartum.php";
</script> 

