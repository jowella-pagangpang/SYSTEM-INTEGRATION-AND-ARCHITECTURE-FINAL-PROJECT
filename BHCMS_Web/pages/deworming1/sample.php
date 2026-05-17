<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');

session_start();
if (!isset($_SESSION['type'])) {
    header("Location: ../../index.php");
} else {
    ob_start();
    ?>

    <head>
        <?php
        include('../headsidecss.php');
        ?>

        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <title>Deworming Services</title>
        <link rel="icon" href="../../img/logo.png">
        <link rel="stylesheet" href="styles.css">

        <style type="text/css">
            <!-- Your existing styles -->
        </style>

    </head>

    <body class="hold-transition sidebar-mini">

        <div class="wrapper">
            <?php
            include('../sidebar.php');
            ?>

            <?php
            if ($_SESSION['type'] == "Barangay Health Worker") {
                ?>

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
                    <!-- Your existing sidebar content -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Your existing content -->

                    <?php
                    // Fetch all clients without age restriction
                    $dewormingAll = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                        DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                        CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                        purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                        DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                        remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id");

                    // Filter clients based on age and display them in the respective categories
                    while ($data = mysqli_fetch_array($dewormingAll)) {
                        $currentYear = date('Y');
                        $birthYear = date('Y', strtotime($data['birthdate']));
                        $age = $currentYear - $birthYear;

                        if ($age >= 1 && $age <= 4) {
                            // Display in 1-4 years old category
                            // Your existing code for 1-4 years old category
                        } elseif ($age >= 5 && $age <= 9) {
                            // Display in 5-9 years old category
                            // Your existing code for 5-9 years old category
                        } elseif ($age >= 10 && $age <= 19) {
                            // Display in 10-19 years old category
                            // Your existing code for 10-19 years old category
                        }

                        // Automatically hide records for clients who have reached the age of 20
                        if ($age >= 20) {
                            continue; // Skip the rest of the loop
                        }
                    }
                    ?>

                </div>
                <!-- /.content-wrapper -->

            <?php } elseif ($_SESSION['type'] == "Nurse") {
                header("Location: ../../index.php");
            } ?>

            <script src="script.js"></script>

            <!-- DataTables -->
            <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

            <script>
                $(document).ready(function () {
                    // Your existing DataTable initialization code
                });
            </script>

        <?php } ?>
    </body>

</html>
