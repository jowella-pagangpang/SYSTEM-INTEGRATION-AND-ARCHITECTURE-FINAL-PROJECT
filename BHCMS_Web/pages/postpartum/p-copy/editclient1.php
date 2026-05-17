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

        <title>Postpartum Care</title>
        <link rel="icon" href="../../img/logo.png">

        <style>
            #ironDiv {
                display: none;
            }

            #vitaminDiv {
                display: none;
            }
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
                    <h1 class="brand-link text-center">
                        <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">
                            Health Record Management
                        </span>
                    </h1>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar panel -->
                        <div class="user-panel pb-3 mb-3">
                            <center><img src="../../img/logo.png" style="height: 40%; width: 40%;" alt="logo"></center>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2" style="font-family: Helvetica;">
                            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="../main/dashboard.php" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#" class="nav-link active">
                                        <i class="nav-icon fas fa-notes-medical"></i>
                                        <p>
                                            Health Services
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../immunization/immunization.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Immunization (0-12 mos. old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming1/deworming1-4.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (1-4 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming2/deworming5-9.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (5-9 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../deworming3/deworming10-19.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Deworming (10-19 years old)</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition1/nutrition1.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program I</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../nutrition2/nutrition2.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nutrition and EPI Program II</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../sickchildren/sickchildren.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Sick Children</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../maternal/maternal.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Maternal Care</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../postpartum/postpartum.php" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Postpartum Care</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-chart-pie"></i>
                                        <p>
                                            Report
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../main/report.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p> Generate Report</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="../main/client.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Client Report</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <section class="content text-sm" style="font-family: Helvetica;">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="card">

                                    <form method="post">
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-5">

                                                        <h5 class="font-weight-bold">Update client record</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>


                                            <?php
                                            $pid = $_GET['pid'];
                                            $edit = mysqli_query($con, "SELECT * FROM postpartum WHERE postpartum_id = '$pid'");
                                            $row = mysqli_fetch_assoc($edit); ?>


                                            <div>
                                                <input type="hidden" name="postpartum_id"
                                                    value="<?php echo $row['postpartum_id']; ?>">
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Date of Delivery:</label>
                                                <div class="col-md-7">
                                                    <input name="delivery_date" class="form-control form-control-sm" type="date"
                                                        placeholder="Date of Delivery"
                                                        value="<?php echo $row['delivery_date']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Time of Delivery:</label>
                                                <div class="col-md-7">
                                                    <input name="delivery_time" class="form-control form-control-sm" type="text"
                                                        placeholder="Time of Delivery"
                                                        value="<?php echo $row['delivery_time']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">First Name:</label>
                                                <div class="col-md-7">
                                                    <input name="fname" type="text" class="form-control form-control-sm"
                                                        placeholder="First Name" value="<?php echo $row['fname']; ?>"
                                                        oninput="validateInput(this)">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Middle Initial:</label>
                                                <div class="col-md-7">
                                                    <input name="minitial" type="text" class="form-control form-control-sm"
                                                        placeholder="Middle Initial" value="<?php echo $row['minitial']; ?>"
                                                        oninput="validateInput(this)">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Last Name:</label>
                                                <div class="col-md-7">
                                                    <input name="lname" type="text" class="form-control form-control-sm"
                                                        placeholder="Last Name" value="<?php echo $row['lname']; ?>"
                                                        oninput="validateInput(this)">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Address:</label>
                                                <div class="col-md-7">
                                                    <select name="purok" class="form-control form-control-sm"
                                                        style="width: 100%;">
                                                        <option selected>
                                                            <?php echo $row['purok']; ?>
                                                        </option>
                                                        <option value="Purok 93">Purok 93</option>
                                                        <option value="Purok 94">Purok 94</option>
                                                        <option value="Purok 95">Purok 95</option>
                                                        <option value="Purok 96">Purok 96</option>
                                                        <option value="Purok 97">Purok 97</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left"></label>
                                                <div class="col-md-7">
                                                    <input name="address" class="form-control form-control-sm" type="text"
                                                        value="<?php echo $row['address']; ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Date within 24 hours after
                                                    delivery:</label>
                                                <div class="col-md-7">
                                                    <input name="date_visit_24hr" class="form-control form-control-sm"
                                                        type="date" placeholder="Date within 24 hours after delivery"
                                                        value="<?php echo $row['date_visit_24hr']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Date within 1 week after
                                                    delivery:</label>
                                                <div class="col-md-7">
                                                    <input name="date_visit_1week" class="form-control form-control-sm"
                                                        type="date" placeholder="Date within 1 week after delivery"
                                                        value="<?php echo $row['date_visit_1week']; ?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Date Initiated
                                                    Breastfeeding:</label>
                                                <div class="col-md-7">
                                                    <input name="date_breastfeed" class="form-control form-control-sm"
                                                        type="date" placeholder="Date Initiated Breastfeeding"
                                                        value="<?php echo $row['date_breastfeed']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Time Initiated
                                                    Breastfeeding:</label>
                                                <div class="col-md-7">
                                                    <input name="time_breastfeed" class="form-control form-control-sm"
                                                        type="text" placeholder="Time Initiated Breastfeeding"
                                                        value="<?php echo $row['time_breastfeed']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Micronutrient
                                                    Supplementation:</label>
                                                <div class="col-md-7">
                                                    <select name="supplement" id="supplement"
                                                        class="form-control form-control-sm" style="width: 100%;">
                                                        <option selected disabled value="">Select Supplementation</option>
                                                        <option value="iron">Iron</option>
                                                        <option value="vitamin">Vitamin A</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="ironDiv">
                                                <div class="form-group row">
                                                    <label class="col-md-5 col-form-label text-md-left">1st Date:</label>
                                                    <div class="col-md-4">
                                                        <input name="iron_supplementation_1stdate"
                                                            class="form-control form-control-sm" type="date"
                                                            placeholder="Iron Supplementation Date"
                                                            value="<?php echo $row['iron_supplementation_1stdate']; ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="1stdate_tablets" class="form-control form-control-sm"
                                                            type="number" placeholder="No. Tablets" min="0"
                                                            value="<?php echo max(0, $row['1stdate_tablets']); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-5 col-form-label text-md-left">2nd Date:</label>
                                                    <div class="col-md-4">
                                                        <input name="iron_supplementation_2nddate"
                                                            class="form-control form-control-sm" type="date"
                                                            placeholder="Iron Supplementation Date"
                                                            value="<?php echo $row['iron_supplementation_2nddate']; ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="2nddate_tablets" class="form-control form-control-sm"
                                                            type="number" placeholder="No. Tablets" min="0"
                                                            value="<?php echo max(0, $row['2nddate_tablets']); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-5 col-form-label text-md-left">3rd Date:</label>
                                                    <div class="col-md-4">
                                                        <input name="iron_supplementation_3rddate"
                                                            class="form-control form-control-sm" type="date"
                                                            placeholder="Iron Supplementation Date"
                                                            value="<?php echo $row['iron_supplementation_3rddate']; ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="3rddate_tablets" class="form-control form-control-sm"
                                                            type="number" placeholder="No. Tablets" min="0"
                                                            value="<?php echo max(0, $row['3rddate_tablets']); ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="vitaminDiv">
                                                <div class="form-group row">
                                                    <label class="col-md-5 col-form-label text-md-left">Date:</label>
                                                    <div class="col-md-7">
                                                        <input name="vitamin_supplementation_date"
                                                            class="form-control form-control-sm" type="date"
                                                            placeholder="Vitamin A Supplementation Date"
                                                            value="<?php echo $row['vitamin_supplementation_date']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-left">Remarks:</label>
                                                <div class="col-md-7">
                                                    <textarea name="remarks" class="form-control form-control-sm"
                                                        rows="2"><?php echo $row['remarks']; ?></textarea>
                                                </div>
                                            </div>


                                            <div class="modal-footer">

                                                <a href="../postpartum/postpartum.php">
                                                    <button type="button" class="btn btn-default">Cancel</button>
                                                </a>
                                                <button type="submit" name="update" class="btn btn-primary">Update
                                                    client</button>
                                            </div>

                                    </form>

                                    <?php

                                    if (isset($_POST['update'])) {
                                        $delivery_date = $_POST['delivery_date'];
                                        $delivery_time = $_POST['delivery_time'];
                                        $fname = $_POST['fname'];
                                        $minitial = $_POST['minitial'];
                                        $lname = $_POST['lname'];
                                        $purok = $_POST['purok'];
                                        $address = $_POST['address'];
                                        $date_visit_24hr = $_POST['date_visit_24hr'];
                                        $date_visit_1week = $_POST['date_visit_1week'];
                                        $date_breastfeed = $_POST['date_breastfeed'];
                                        $time_breastfeed = $_POST['time_breastfeed'];
                                        $iron_supplementation_1stdate = $_POST['iron_supplementation_1stdate'];
                                        $firstdate_tablets = $_POST['1stdate_tablets'];
                                        $iron_supplementation_2nddate = $_POST['iron_supplementation_2nddate'];
                                        $seconddate_tablets = $_POST['2nddate_tablets'];
                                        $iron_supplementation_3rddate = $_POST['iron_supplementation_3rddate'];
                                        $thirddate_tablets = $_POST['3rddate_tablets'];
                                        $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
                                        $remarks = $_POST['remarks'];
                                        $remarks = mysqli_real_escape_string($con, $remarks);
                                        $pid = $_GET['pid'];

                                        mysqli_query($con, "UPDATE postpartum SET delivery_date='$delivery_date', delivery_time='$delivery_time', fname='$fname', 
    minitial='$minitial', lname='$lname', purok='$purok', address='$address',
    date_visit_24hr='$date_visit_24hr', date_visit_1week='$date_visit_1week', date_breastfeed='$date_breastfeed', 
    time_breastfeed='$time_breastfeed', iron_supplementation_1stdate='$iron_supplementation_1stdate', 1stdate_tablets='$firstdate_tablets',
    iron_supplementation_2nddate='$iron_supplementation_2nddate', 2nddate_tablets='$seconddate_tablets', 
    iron_supplementation_3rddate='$iron_supplementation_3rddate', 3rddate_tablets='$thirddate_tablets', 
    vitamin_supplementation_date='$vitamin_supplementation_date', remarks='$remarks' WHERE postpartum_id = '$pid'"); ?>

                                        <script type="text/javascript">
                                            alert("A client record has been updated.");
                                            window.location = "../postpartum/postpartum.php";
                                        </script>

                                        <?php
                                    }

                                    ?>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="col-2"></div>
                        </div>
                </div>
                </section>
            </div>
            </div>
            <!-- ./wrapper -->

            <script>
                function validateInput(inputElement) {
                    let inputValue = inputElement.value;
                    let lettersOnly = inputValue.replace(/[^a-zA-Z\s.]/g, '');

                    if (inputValue !== lettersOnly) {
                        let selectionStart = inputElement.selectionStart;
                        let selectionEnd = inputElement.selectionEnd;

                        inputElement.value = lettersOnly;

                        // Restore cursor position
                        inputElement.setSelectionRange(selectionStart, selectionEnd);
                    }
                }

                // disable date
                const datePickers = document.querySelectorAll(".date-picker");

                    datePickers.forEach(function(datePicker) {
                        if (datePicker.value) {
                        datePicker.disabled = true;
                    }
                });

                const supplementSelect = document.getElementById('supplement');
                const ironDiv = document.getElementById('ironDiv');
                const vitaminDiv = document.getElementById('vitaminDiv');

                supplementSelect.addEventListener('change', function () {
                    if (supplementSelect.value === 'iron') {
                        ironDiv.style.display = 'block';
                    } else {
                        ironDiv.style.display = 'none';
                    }

                    if (supplementSelect.value === 'vitamin') {
                        vitaminDiv.style.display = 'block';
                    } else {
                        vitaminDiv.style.display = 'none';
                    }
                });
            </script>


        <?php } elseif ($_SESSION['type'] == "Nurse") {
                header("Location: ../../index.php");
            } ?>

        <!-- DataTables -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

        <?php
}
?>

</body>

</html>