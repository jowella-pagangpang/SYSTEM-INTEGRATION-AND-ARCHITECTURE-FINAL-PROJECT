<?php
include("../dbcon.php");

$sid = $_GET['sid'];
mysqli_query($con, "DELETE FROM sickchildren WHERE sick_children_id = '$sid'");
?>

<script type="text/javascript">
    window.location="../sickchildren/sickchildren.php";
</script> 

