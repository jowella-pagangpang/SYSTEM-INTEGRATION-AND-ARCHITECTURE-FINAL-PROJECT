<?php
include("../dbcon.php");

$nid2 = $_GET['nid2'];
mysqli_query($con, "DELETE FROM nutrition2 WHERE nutrition2_id = '$nid2'");
?>

<script type="text/javascript">
    window.location="../nutrition2/nutrition2.php";
</script> 

