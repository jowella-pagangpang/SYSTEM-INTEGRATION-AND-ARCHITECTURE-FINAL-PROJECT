<?php

include('../dbcon.php');

if (isset($_POST['submit1'])) {
    $remarks_24hr = $_POST['remarks_24hr'];
    $remarks_24hr = mysqli_real_escape_string($con, $remarks_24hr);
    $id = $_POST['id'];

    mysqli_query($con,"UPDATE postpartum SET remarks_24hr = '$remarks_24hr' WHERE postpartum_id ='$id' ");
    header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>


<?php

include('../dbcon.php');

if (isset($_POST['submit2'])) {
    $remarks_1week = $_POST['remarks_1week'];
    $remarks_1week = mysqli_real_escape_string($con, $remarks_1week);
    $id = $_POST['id'];


    mysqli_query($con,"UPDATE postpartum SET remarks_1week = '$remarks_1week' WHERE postpartum_id ='$id' ");
     header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>