<?php

session_start();
include('../dbcon.php');

if (isset($_POST['update'])) {
  $deworming1_id = $_POST['deworming1_id'];
  $reg_date = $_POST['reg_date'];
  $birth_date = $_POST['birth_date'];
  $fname = $_POST['fname'];
  $minitial = $_POST['minitial'];
  $lname = $_POST['lname'];
  $sex = $_POST['sex'];
  $mother_name = $_POST['mother_name'];
  $purok = $_POST['purok'];
  $address = $_POST['address'];
  $age = $_POST['age'];
  $first = $_POST['1stdose'];
  $second = $_POST['2nddose'];
  $remarks = $_POST['remarks'];

  mysqli_query($con, "UPDATE deworming1 SET reg_date='$reg_date', birth_date='$birth_date', fname='$fname', 
  minitial='$minitial', lname='$lname', sex='$sex', mother_name='$mother_name', purok='$purok', address='$address',
  age='$age', 1stdose='$first', 2nddose='$second', remarks='$remarks' WHERE deworming1_id = '$deworming1_id'"); ?>

  <script type="text/javascript">
    alert("A patient record has been updated.");
    window.location = "../deworming1/deworming1-4.php";
  </script>

  <?php
}
?>
