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
                                    <a href="../sickchildren/sickchildren.php" class="nav-link active">
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
                                    <a href="../postpartum/postpartum.php" class="nav-link">
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
                                <h4 class="font-weight-bold" style="font-family: Helvetica;">SICK CHILDREN</h4>
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
                                            $edit = mysqli_query($con, "SELECT * FROM sickchildren INNER JOIN client ON sickchildren.patientid = client.id 
                                                WHERE sick_children_id = $id;");
                                            $row = mysqli_fetch_assoc($edit); ?>


                                            <div>
                                                <input name="sick_children_id" type="hidden"
                                                    value="<?php echo $row['sick_children_id']; ?>">
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Client ID:</label>
                                                    <input name="patientid" class="form-control form-control-sm"
                                                        type="number" value="<?php echo $row['patientid']; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div style="text-align: center;">
                                                    <label>Vitamin A Supplementation</label><br>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Age:<br></label>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" name="vitamin_6to11mos" value="✓"
                                                                    id="todoCheck3" <?php if ($row['vitamin_6to11mos'] == "✓")
                                                                        echo 'checked'; ?>>
                                                                <label for="todoCheck3"></label>
                                                                <span class="text">6-11 months</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><br></label>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" name="vitamin_12to59mos" value="✓"
                                                                    id="todoCheck4" <?php if ($row['vitamin_12to59mos'] == "✓")
                                                                        echo 'checked'; ?>>
                                                                <label for="todoCheck4"></label>
                                                                <span class="text">12-59 months</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                            <?php
                                            $diag = $row['diagnosis'];
                                            $vit = $row['vitamin_supplementation_date'];
                                            $readonly1 = ($diag === '') ? '' : 'readonly';
                                            $readonly2 = ($vit === '0000-00-00') ? '' : 'readonly';
                                            ?>
                                                            <label>Diagnosis/Findings:</label>
                                                            <input name="diagnosis" class="form-control form-control-sm"
                                                                type="text" 
                                                                value="<?php echo $diag; ?>" <?php echo $readonly1; ?> >
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Date Given:</label>
                                                            <input name="vitamin_supplementation_date"
                                                                class="form-control form-control-sm" type="date"
                                                                value="<?php echo $vit; ?>" <?php echo $readonly2; ?> >
                                                        </div>
                                                    </div>

                                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks1" class="form-control form-control-sm" 
                                                rows="2"><?php echo $row['remarks1']; ?></textarea>
                                            </div>
                                        </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="modal-footer">
                                            <a href="sickchildren-record.php?id=<?php echo $row['patientid']; ?>">
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
            $sick_children_id = $_POST['sick_children_id'];
            $patientid = $_POST['patientid'];
            $vitamin_6to11mos = $_POST['vitamin_6to11mos'];
            $vitamin_12to59mos = $_POST['vitamin_12to59mos'];
            $diagnosis = $_POST['diagnosis'];
            $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
            $remarks1 = $_POST['remarks1'];
            $remarks1 = mysqli_real_escape_string($con, $remarks1);

            mysqli_query($con, "UPDATE sickchildren SET patientid='$patientid', 
            vitamin_6to11mos='$vitamin_6to11mos', vitamin_12to59mos='$vitamin_12to59mos', 
            diagnosis='$diagnosis', vitamin_supplementation_date='$vitamin_supplementation_date', 
            remarks1='$remarks1' WHERE sick_children_id = '$id'"); ?>

            <script type="text/javascript">
                window.location = "sickchildren-record.php?id=<?php echo $row['patientid']; ?>";
            </script>

            <?php
        }
        ?>



        <script>
            $(document).ready(function () {
                $('#todoCheck3').on('change', function () {
                    if ($(this).is(':checked')) {
                        $('#todoCheck4').prop('checked', false);
                    }
                });

                $('#todoCheck4').on('change', function () {
                    if ($(this).is(':checked')) {
                        $('#todoCheck3').prop('checked', false);
                    }
                });
            });

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

        </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>