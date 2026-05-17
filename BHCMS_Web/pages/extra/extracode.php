<script>
    $('#add-patient').on('hidden.bs.modal', function () {
        $('#add-patient form')[0].reset();
    }); 
</script>

//    if (isset($_SESSION['bhw'])) {
//        $bhwlog = 'Added patient: ' . $fname . ' ' . $minitial . ' ' . $lname;
//        $service = 'Deworming for 10-19 years old';
//        $log = mysqli_query($con, "INSERT INTO activitylog (datetime, user, action, services) 
//        VALUES (NOW(), '" . $_SESSION['bhw'] . "', '$bhwlog', '$service')");
//    }

//    else if (isset($_SESSION['nurse'])) {
//        $nurselog = 'Added patient: ' . $fname . ' ' . $minitial . ' ' . $lname;
//        $service = 'Deworming for 10-19 years old';
//        $log = mysqli_query($con, "INSERT INTO activitylog (datetime, user, action, services) 
//        VALUES (NOW(), '" . $_SESSION['nurse'] . "', '$nurselog', '$service')");
//    }