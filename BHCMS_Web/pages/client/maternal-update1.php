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
    <link rel="icon" href="../../img/logo.png">

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
                                            <div class="form-group">
                                                    <?php
                                                    $regDate = $row['reg_date'];
                                                    $readonly = ($regDate === '0000-00-00') ? '' : 'readonly';
                                                    ?>

                                                    <label>Date of Registration: </label>
                                                    <input name="reg_date" class="form-control form-control-sm" type="date"
                                                        value="<?php echo $regDate; ?>" <?php echo $readonly; ?>>
                                                </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    <?php
                                                    $Lmp1 = $row['lmp'];
                                                    $readonly1 = ($Lmp1 === '0000-00-00') ? '' : 'readonly';
                                                    ?>
                                                <label>LMP:</label>
                                                <input name="lmp" class="form-control form-control-sm" type="date"
                                                    value="<?php echo $Lmp1; ?>" <?php echo $readonly1; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <?php
                                                    $g1 = $row['g'];
                                                    $p1 = $row['p'];
                                                    $readonly9 = ($g1 === '0') ? '' : 'readonly';
                                                    $readonly10 = ($p1 === '0') ? '' : 'readonly';
                                                    ?>
                                                <label>G (gravida):</label>
                                                <input name="g" class="form-control form-control-sm" type="number" min="0"
                                                    value="<?php echo $g1; ?>" <?php echo $readonly9; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>P (parity):</label>
                                                <input name="p" class="form-control form-control-sm" type="number" min="0"
                                                    value="<?php echo $p1; ?>" <?php echo $readonly10; ?>>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    <?php
                                                    $edc1 = $row['edc'];
                                                    $readonly2 = ($edc1 === '0000-00-00') ? '' : 'readonly';
                                                    ?>
                                                <label>EDC:</label>
                                                <input name="edc" class="form-control form-control-sm" type="date"
                                                value="<?php echo $edc1; ?>" <?php echo $readonly2; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                        <div style="text-align: center;">
                                            <label>Prenatal Visits</label><br>
                                        </div>
                                        <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php            
                                            $tri1 = $row['trimester1'];
                                            $tri1a = $row['trimester1a'];
                                            $tri2 = $row['trimester2'];
                                            $tri2a = $row['trimester2a'];
                                            $tri3 = $row['trimester3'];
                                            $tri3a = $row['trimester3a'];
                                            $readonly3 = ($tri1 === '0000-00-00') ? '' : 'readonly';
                                            $readonly4 = ($tri1a === '0000-00-00') ? '' : 'readonly';
                                            $readonly5 = ($tri2 === '0000-00-00') ? '' : 'readonly';
                                            $readonly6 = ($tri2a === '0000-00-00') ? '' : 'readonly';
                                            $readonly7 = ($tri3 === '0000-00-00') ? '' : 'readonly';
                                            $readonly8 = ($tri3a === '0000-00-00') ? '' : 'readonly';
                                                ?>
                                                <label>First Trimester:</label>
                                                <input name="trimester1" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri1; ?>" <?php echo $readonly3; ?>>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input name="trimester1a" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri1a; ?>" <?php echo $readonly4; ?>>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Second Trimester:</label>
                                                <input name="trimester2" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri2; ?>" <?php echo $readonly5; ?>>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input name="trimester2a" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri2a; ?>" <?php echo $readonly6; ?>>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Third Trimester:</label>
                                                <input name="trimester3" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri3; ?>" <?php echo $readonly7; ?>>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label><br></label>
                                                <input name="trimester3a" type="date" class="form-control form-control-sm" 
                                                value="<?php echo $tri3a; ?>" <?php echo $readonly8; ?>>
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
            $reg_date = $_POST['reg_date'];
            $lmp = $_POST['lmp'];
            $g = $_POST['g'];
            $p = $_POST['p'];
            $edc = $_POST['edc'];
            $trimester1 = $_POST['trimester1'];
            $trimester1a = $_POST['trimester1a'];
            $trimester2 = $_POST['trimester2'];
            $trimester2a = $_POST['trimester2a'];
            $trimester3 = $_POST['trimester3'];
            $trimester3a = $_POST['trimester3a'];

            mysqli_query($con, "UPDATE maternal SET patientid='$patientid', 
            reg_date='$reg_date', lmp='$lmp', g='$g', p='$p', edc='$edc', trimester1='$trimester1', trimester1a='$trimester1a', 
            trimester2='$trimester2', trimester2a='$trimester2a', trimester3='$trimester3', trimester3a='$trimester3a' WHERE maternal_id = '$id'"); ?>

            <script type="text/javascript">
                window.location = "maternal-record.php?id=<?php echo $row['patientid']; ?>";
            </script>

            <?php
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

        // disable date
        const datePickers = document.querySelectorAll(".date-picker");

            datePickers.forEach(function(datePicker) {
                if (datePicker.value) {
                datePicker.disabled = true;
            }
        });

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



        const maternalSelect = document.getElementById('maternal');
                const prenatalDiv = document.getElementById('prenatalDiv');
                const ttDiv = document.getElementById('ttDiv');
                const ironDiv = document.getElementById('ironDiv');
                const stiDiv = document.getElementById('stiDiv');
                const pregDiv = document.getElementById('pregDiv');
                const liveDiv = document.getElementById('liveDiv');


                maternalSelect.addEventListener('change', function () {
                    if (maternalSelect.value === 'prenatal') {
                        prenatalDiv.style.display = 'block';
                    } else {
                        prenatalDiv.style.display = 'none';
                    }
            
                    if (maternalSelect.value === 'tt') {
                        ttDiv.style.display = 'block';
                    } else {
                        ttDiv.style.display = 'none';
                    }

                    if (maternalSelect.value === 'iron') {
                        ironDiv.style.display = 'block';
                    } else {
                        ironDiv.style.display = 'none';
                    }
            
                    if (maternalSelect.value === 'sti') {
                        stiDiv.style.display = 'block';
                    } else {
                        stiDiv.style.display = 'none';
                    }
            
                    if (maternalSelect.value === 'preg') {
                        pregDiv.style.display = 'block';
                    } else {
                        pregDiv.style.display = 'none';
                    }
            
                    if (maternalSelect.value === 'live') {
                        liveDiv.style.display = 'block';
                    } else {
                        liveDiv.style.display = 'none';
                    }

                });
        </script>


    <?php } elseif ($_SESSION['type'] == "Nurse") {
            header("Location: ../../index.php");
        } ?>


</body>

</html>