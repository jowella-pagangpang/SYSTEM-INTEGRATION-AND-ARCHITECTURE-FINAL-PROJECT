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
                                <h4 class="font-weight-bold" style="font-family: Helvetica;">MATERNAL CARE</h4>
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
                                            $edit = mysqli_query($con, "SELECT * FROM maternal INNER JOIN client ON maternal.patientid = client.id 
                                                WHERE maternal_id = $id;");
                                            $row = mysqli_fetch_assoc($edit); ?>


                                            <div>
                                                <input name="maternal_id" type="hidden"
                                                    value="<?php echo $row['maternal_id']; ?>">
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
                        <label>Date and Number Iron with Folic Acid was given</label><br><br>
                    </div>
                    <div class="row" id="formFields">
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            $dateFieldName = "iron{$i}date";
                            $numberFieldName = "{$i}datenumber";
                            $dateValue = $row[$dateFieldName];
                            $numberValue = max(0, $row[$numberFieldName]);
                            ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <input name="<?php echo $dateFieldName; ?>" class="form-control form-control-sm" type="date" 
                                            value="<?php echo $dateValue; ?>" <?php echo ($dateValue !== '0000-00-00') ? 'readonly' : ''; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Number:</label>
                                            <input name="<?php echo $numberFieldName; ?>" class="form-control form-control-sm" type="number" 
                                            min="0" value="<?php echo $numberValue; ?>" <?php echo ($numberValue !== 0) ? 'readonly' : ''; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Add Button -->
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block btn-xs" id="addButton">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                                        </div>


                                        <div class="modal-footer">
                                            <a href="maternal-record.php?id=<?php echo $row['patientid']; ?>">
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
            $maternal_id = $_POST['maternal_id'];
            $patientid = $_POST['patientid'];
            $ironDates = [];
            $datenumberValues = [];

            for ($i = 1; $i <= 6; $i++) {
                $dateFieldName = "iron{$i}date";
                $numberFieldName = "{$i}datenumber";

                $ironDates[] = $_POST[$dateFieldName];
                $datenumberValues[] = $_POST[$numberFieldName];
            }

            $updateQuery = "UPDATE maternal SET patientid='$patientid'";

            for ($i = 1; $i <= 6; $i++) {
                $updateQuery .= ", iron{$i}date = '{$ironDates[$i - 1]}', {$i}datenumber = '{$datenumberValues[$i - 1]}'";
            }

            $updateQuery .= " WHERE maternal_id = '$id'";

            // Execute the update query
            if (mysqli_query($con, $updateQuery)) {
                // Update successful
                ?>
                <script type="text/javascript">
                    window.location = "maternal-record.php?id=<?php echo $row['patientid']; ?>";
                </script>
                <?php
            } else {
                // Handle the error here if the update fails
                echo "Error updating record: " . mysqli_error($con);
            }
        }

        ?>



        <script>
            function validateInput(inputElement) {
                let inputValue = inputElement.value;
                let lettersOnly = inputValue.replace(/[^a-zA-Z\s.-]/g, '');

                if (inputValue !== lettersOnly) {
                    let selectionStart = inputElement.selectionStart;
                    let selectionEnd = inputElement.selectionEnd;

                    inputElement.value = lettersOnly;

                    inputElement.setSelectionRange(selectionStart, selectionEnd);
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                const formFields = document.getElementById("formFields");
                const addButton = document.getElementById("addButton");
                let fieldNumber = 2;

                // Function to check if a field is empty
                function isEmpty(fieldValue) {
                    return fieldValue === "" || fieldValue === "0000-00-00" || parseInt(fieldValue) === 0;
                }

                // Function to count the number of empty fields
                function countEmptyFields() {
                    let emptyFieldCount = 0;
                    for (let i = 2; i <= 6; i++) {
                        const dateFieldName = `iron${i}date`;
                        const numberFieldName = `${i}datenumber`;
                        const dateInput = document.querySelector(`input[name="${dateFieldName}"]`);
                        const numberInput = document.querySelector(`input[name="${numberFieldName}"]`);

                        if (isEmpty(dateInput.value) && isEmpty(numberInput.value)) {
                            emptyFieldCount++;
                        }
                    }
                    return emptyFieldCount;
                }

                // Function to show or hide empty fields based on the count
                function updateFieldVisibility() {
                    const emptyFieldCount = countEmptyFields();

                    for (let i = 2; i <= 6; i++) {
                        const dateFieldName = `iron${i}date`;
                        const numberFieldName = `${i}datenumber`;
                        const dateInput = document.querySelector(`input[name="${dateFieldName}"]`);
                        const numberInput = document.querySelector(`input[name="${numberFieldName}"]`);

                        if (i <= fieldNumber || (!isEmpty(dateInput.value) || !isEmpty(numberInput.value))) {
                            dateInput.closest(".col-md-12").style.display = "";
                            numberInput.closest(".col-md-12").style.display = "";
                        } else {
                            dateInput.closest(".col-md-12").style.display = "none";
                            numberInput.closest(".col-md-12").style.display = "none";
                        }
                    }
                }

                // Function to update the form action URL with the emptyFieldCount value
                function updateFormAction() {
                    const emptyFieldCount = countEmptyFields();
                    const form = document.getElementById("editclient");
                    let formAction = form.getAttribute("action");

                    if (formAction.includes("?")) {
                        formAction += `&emptyFieldCount=${emptyFieldCount}`;
                    } else {
                        formAction += `?emptyFieldCount=${emptyFieldCount}`;
                    }

                    // Update the form action attribute
                    form.setAttribute("action", formAction);
                }

                // Show initially hidden empty fields
                updateFieldVisibility();

                addButton.addEventListener("click", function () {
                    fieldNumber++;
                    updateFieldVisibility();
                    updateFormAction();

                    const emptyFieldCount = countEmptyFields();
                    if (emptyFieldCount === 0) {
                        addButton.style.display = "none";
                    }
                });

                // Initial form action update
                updateFormAction();
            });


        </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>