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

        <title>Maternal Care</title>
        <link rel="icon" href="../../img/logo.png">

        <style>
        .form-control:focus {
            border-color: #007bff; /* Change to the desired highlight color */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
            outline: none; /* Remove the default focus outline if needed */
        }

        #vitaminDiv {
            display: none;
        }

        #diarDiv {
            display: none;
        }

        #pneuDiv {
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
                <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
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
                                <a href="../maternal/maternal.php" class="nav-link active">
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
                            <h4 class="font-weight-bold" style="font-family: Helvetica;">CONSULTATION</h4>
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

                            <form method="post" action="add-insert.php">
                                <div class="card-body d-flex flex-column">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-5">

                                                <h5 class="font-weight-bold">Add consultation</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">


                                            <?php
                                            $mid = $_GET['mid'];
                                            $edit = mysqli_query($con, "SELECT * FROM maternal INNER JOIN client 
                                            ON maternal.patientid = client.id WHERE patientid = $mid;");
                                            $row = mysqli_fetch_assoc($edit); ?>
                                            
                                            <div>
                                                <input name="consult_id" type="hidden">
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Client ID:</label>
                                                    <input name="patientid" class="form-control form-control-sm"
                                                        type="number" value="<?php echo $mid; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="date" style="font-size: 15px;">Date: <?php echo date("m-d-Y"); ?></label>
                                                    <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                                                </div>
                                            </div>
                                

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Weight (kg):</label>
                                                    <input name="weight" class="form-control form-control-sm"
                                                        type="number" min="0" placeholder="Weight">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Height (cm):</label>
                                                    <input name="height" class="form-control form-control-sm"
                                                        type="number" min="0" placeholder="Height">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Diagnosis:</label>
                                                <textarea name="diagnosis" class="form-control form-control-sm" 
                                                rows="2"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Treatment:</label>
                                                <textarea name="treatment" class="form-control form-control-sm" 
                                                rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remarks:</label>
                                                <textarea name="remarks" class="form-control form-control-sm" 
                                                rows="2"></textarea>
                                            </div>
                                        </div>
                          
                        </div>


                                    <div class="modal-footer">
                                        <a href="../maternal/maternal.php">
                                        <button type="button" class="btn btn-default">Cancel</button>
                                        </a>
                                        <button type="submit" id="submitBtn" name="submit" class="btn btn-primary">Add</button>
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

    document.addEventListener("DOMContentLoaded", function () {
        // Disable the "Add" button initially
        document.getElementById("submitBtn").disabled = true;

        // Add an event listener to the form inputs for input changes
        document.querySelectorAll(".form-control").forEach(function (input) {
            input.addEventListener("input", function () {
                // Check if at least one input field is not empty
                var isAnyInputNotEmpty = Array.from(document.querySelectorAll(".form-control"))
                    .some(function (input) {
                        return input.value.trim() !== "";
                    });

                // Enable or disable the "Add" button based on the input
                document.getElementById("submitBtn").disabled = !isAnyInputNotEmpty;
            });
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

    const datePickers = document.querySelectorAll(".date-picker");

        datePickers.forEach(function(datePicker) {
            if (datePicker.value) {
            datePicker.disabled = true;
        }
    });

        const treatmentSelect = document.getElementById('treatment');
        const vitaminDiv = document.getElementById('vitaminDiv');
        const diarDiv = document.getElementById('diarDiv');
        const pneuDiv = document.getElementById('pneuDiv');

        treatmentSelect.addEventListener('change', function () {
            if (treatmentSelect.value =='vitamin') {
                vitaminDiv.style.display = 'block';
            } else {
                vitaminDiv.style.display = 'none';
            }

            if (treatmentSelect.value === 'diar') {
                diarDiv.style.display = 'block';
            } else {
                diarDiv.style.display = 'none';
            }

            if (treatmentSelect.value === 'pneu') {
                pneuDiv.style.display = 'block';
            } else {
                pneuDiv.style.display = 'none';
            }
        });
</script>

        <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>

        <?php
}
?>

</body>

</html>