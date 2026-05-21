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
            border-color: #007bff; /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
            outline: none; /* Remove the default focus outline if needed */
        }

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

                                <div class="col-md-12">
                                    <label>Micronutrient Supplementation</label>
                                    <div class="form-group">
                                        <select name="supplement" id="supplement" class="form-control form-control-sm"
                                            style="width: 100%;">
                                            <option selected disabled value="">Select Supplementation</option>
                                            <option value="iron">Iron</option>
                                            <option value="vitamin">Vitamin A</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="ironDiv" class="col-md-12">
                                                    <?php
                                                    $firstdate = $row['iron_supplementation_1stdate'];
                                                    $firsttab = $row['1stdate_tablets'];
                                                    $seconddate = $row['iron_supplementation_2nddate'];
                                                    $secondtab = $row['2nddate_tablets'];
                                                    $thirddate = $row['iron_supplementation_3rddate'];
                                                    $thirdtab = $row['3rddate_tablets'];
                                                    $readonly1 = ($firstdate === '0000-00-00') ? '' : 'readonly';
                                                    $readonly2 = ($firsttab === '0') ? '' : 'readonly';
                                                    $readonly3 = ($seconddate === '0000-00-00') ? '' : 'readonly';
                                                    $readonly4 = ($secondtab === '0') ? '' : 'readonly';
                                                    $readonly5 = ($thirddate === '0000-00-00') ? '' : 'readonly';
                                                    $readonly6 = ($thirdtab === '0') ? '' : 'readonly';
                                                    ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>1st Date:<br></label>
                                                <input name="iron_supplementation_1stdate"
                                                    class="form-control form-control-sm" type="date"
                                                    value="<?php echo $firstdate; ?>" <?php echo $readonly1; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="1stdate_tablets" class="form-control form-control-sm"
                                                placeholder="No. Tablets"
                                                    type="number" value="<?php echo $firsttab; ?>" <?php echo $readonly2; ?>>
                                            </div>
                                        </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>2nd Date:<br></label>
                                                <input name="iron_supplementation_2nddate"
                                                    class="form-control form-control-sm" type="date"
                                                    value="<?php echo $seconddate; ?>" <?php echo $readonly3; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="2nddate_tablets" class="form-control form-control-sm"
                                                placeholder="No. Tablets"
                                                    type="number" value="<?php echo $secondtab; ?>" <?php echo $readonly4; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>3rd Date:<br></label>
                                                <input name="iron_supplementation_3rddate"
                                                    class="form-control form-control-sm" type="date"
                                                    value="<?php echo $thirddate; ?>" <?php echo $readonly5; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="3rddate_tablets" class="form-control form-control-sm"
                                                placeholder="No. Tablets"
                                                    type="number" value="<?php echo $thirdtab; ?>" <?php echo $readonly6; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div id="vitaminDiv" class="col-md-12">
                                            <div class="form-group">
                                                    <?php
                                                    $vitamin = $row['vitamin_supplementation_date'];
                                                    $readonly = ($vitamin === '0000-00-00') ? '' : 'readonly';
                                                    ?>
                                                <label>Date:<br></label>
                                                <input name="vitamin_supplementation_date"
                                                    class="form-control form-control-sm" type="date"
                                                    value="<?php echo $vitamin; ?>" <?php echo $readonly; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks" class="form-control form-control-sm"
                                                    rows="2"><?php echo $row['remarks']; ?></textarea>
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
            $iron_supplementation_1stdate = $_POST['iron_supplementation_1stdate'];
            $firstdate_tablets = $_POST['1stdate_tablets'];
            $iron_supplementation_2nddate = $_POST['iron_supplementation_2nddate'];
            $seconddate_tablets = $_POST['2nddate_tablets'];
            $iron_supplementation_3rddate = $_POST['iron_supplementation_3rddate'];
            $thirddate_tablets = $_POST['3rddate_tablets'];
            $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
            $remarks = $_POST['remarks'];
            $remarks = mysqli_real_escape_string($con, $remarks);

            mysqli_query($con, "UPDATE postpartum SET patientid='$patientid', 
            iron_supplementation_1stdate='$iron_supplementation_1stdate', 1stdate_tablets='$firstdate_tablets',
            iron_supplementation_2nddate='$iron_supplementation_2nddate', 2nddate_tablets='$seconddate_tablets', 
            iron_supplementation_3rddate='$iron_supplementation_3rddate', 3rddate_tablets='$thirddate_tablets', 
            vitamin_supplementation_date='$vitamin_supplementation_date', remarks='$remarks' WHERE postpartum_id = '$id'"); ?>

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


</body>

</html>