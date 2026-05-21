<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<head>
    <?php
    include('../headsidecss.php');
    ?>

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <title>Client Record</title>
    <link rel="icon" href="../../img/basak logo.png">

    <style>
        .form-control:focus {
            border-color: #007bff;
            /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Optional box shadow effect */
            outline: none;
            /* Remove the default focus outline if needed */
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
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../client/client-list.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Client
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
                            <p>Immunization Services</p>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="../deworming1/deworming.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deworming Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                          <a href="../nutrition2/nutrition2.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nutrition Program</p>
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
                            <li class="nav-item">
                                <a href="../client/general-consult.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Consultation</p>
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
                                            <p>Custom Report</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../main/client.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Follow-up Health Service</p>
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
                                <h4 class="font-weight-bold" style="font-family: Helvetica;">POSTPARTUM CARE</h4>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <section class="content text-sm" style="font-family: Helvetica;">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="card">

                                <form method="post">
                                    <div class="card-body d-flex flex-column">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-5">

                                                    <h5 class="font-weight-bold">Update record</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <?php
                                            $id = $_GET['id'];
                                            $edit = mysqli_query($con, "SELECT * FROM postpartum INNER JOIN client ON postpartum.patientid = client.id 
                                                WHERE postpartum_id = $id;");
                                            $row = mysqli_fetch_assoc($edit); ?>


                                            <div>
                                                <input name="postpartum_id" type="hidden"
                                                    value="<?php echo $row['postpartum_id']; ?>">
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Client ID:</label>
                                                    <input name="patientid" class="form-control form-control-sm"
                                                        type="number" value="<?php echo $row['patientid']; ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <?php
                                                    $deliveryDate = $row['delivery_date'];
                                                    $deliveryTime = $row['delivery_time'];
                                                    $readonly1 = ($deliveryDate === '0000-00-00') ? '' : 'readonly';
                                                    $readonly2 = ($deliveryTime === '') ? '' : 'readonly';
                                                    ?>
                                                <label>Date and Time of Delivery:<br></label>
                                                <input name="delivery_date" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $deliveryDate; ?>" <?php echo $readonly1; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input name="delivery_time" class="form-control form-control-sm" type="text"
                                                placeholder="Time of Delivery"
                                                value="<?php echo $deliveryTime; ?>" <?php echo $readonly2; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    <?php
                                                    $date24hr = $row['date_visit_24hr'];
                                                    $date1week = $row['date_visit_1week'];
                                                    $readonly3 = ($date24hr === '0000-00-00') ? '' : 'readonly';
                                                    $readonly4 = ($date1week === '0000-00-00') ? '' : 'readonly';
                                                    ?>
                                                <label>Date within 24 hours after delivery:</label>
                                                <input name="date_visit_24hr" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $date24hr; ?>" <?php echo $readonly3; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                                <label>Date within 1 week after delivery:</label>
                                                <input name="date_visit_1week" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $date1week; ?>" <?php echo $readonly4; ?>>
                                            </div>
                                        </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    <?php
                                                    $datebreastfeed = $row['date_breastfeed'];
                                                    $timebreastfeed = $row['time_breastfeed'];
                                                    $readonly5 = ($datebreastfeed === '0000-00-00') ? '' : 'readonly';
                                                    $readonly6 = ($timebreastfeed === '') ? '' : 'readonly';
                                                    ?>
                                                <label>Date Initiated Breastfeeding:<br></label>
                                                <input name="date_breastfeed" class="form-control form-control-sm"
                                                    type="date" value="<?php echo $datebreastfeed; ?>" <?php echo $readonly5; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time Initiated Breastfeeding:<br></label>
                                                <input name="time_breastfeed" class="form-control form-control-sm"
                                                placeholder="Time Initiated Breastfeeding"
                                                    type="text" value="<?php echo $timebreastfeed; ?>" <?php echo $readonly6; ?>>
                                            </div>
                                        </div>

                                        </div>


                                        <div class="modal-footer">
                                            <a href="postpartum-record.php?id=<?php echo $row['patientid']; ?>">
                                                <button type="button" class="btn btn-default">Cancel</button>
                                            </a>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </div>

                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="col-3"></div>

                    </div>
            </div>
            </section>
        </div>

        </div>
        <!-- ./wrapper -->

        <?php
        if (isset($_POST['update'])) {

            $id = $_GET['id'];
            $postpartum_id = $_POST['postpartum_id'];
            $patientid = $_POST['patientid'];
            $delivery_date = $_POST['delivery_date'];
            $delivery_time = $_POST['delivery_time'];
            $date_visit_24hr = $_POST['date_visit_24hr'];
            $date_visit_1week = $_POST['date_visit_1week'];
            $date_breastfeed = $_POST['date_breastfeed'];
            $time_breastfeed = $_POST['time_breastfeed'];

            mysqli_query($con, "UPDATE postpartum SET patientid='$patientid', 
                delivery_date='$delivery_date', delivery_time='$delivery_time',
                date_visit_24hr='$date_visit_24hr', date_visit_1week='$date_visit_1week', date_breastfeed='$date_breastfeed', 
                time_breastfeed='$time_breastfeed' WHERE postpartum_id = '$id'"); ?>

            <script type="text/javascript">
                window.location = "postpartum-record.php?id=<?php echo $row['patientid']; ?>";
            </script>

            <?php
        }
        ?>


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

            datePickers.forEach(function (datePicker) {
                if (datePicker.value) {
                    datePicker.disabled = true;
                }
            });
        </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>