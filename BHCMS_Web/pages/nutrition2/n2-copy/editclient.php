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

                    <title>Nutrition and EPI Part II</title>
                    <link rel="icon" href="../../img/logo.png">

                    <!-- Include iCheck CSS -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.css">
                    <!-- Include jQuery (required for iCheck) -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Include iCheck JavaScript -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>

                    <style>
                    .form-control:focus {
                        border-color: #007bff; /* Change to the desired highlight color */
                        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
                        outline: none; /* Remove the default focus outline if needed */
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
                                                                    <a href="../nutrition2/nutrition2.php" class="nav-link active">
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
                                                                    <a href="../postpartum/postpartum.php" class="nav-link">
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
                                                <div class="col-3">
                                                </div>

                                                    <div class="col-6">
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

                                                                    <div class="row">

                                                                    <?php
                                                                    $nid2 = $_GET['nid2'];
                                                                    $edit = mysqli_query($con, "SELECT * FROM nutrition2 WHERE nutrition2_id = '$nid2'");
                                                                    $row = mysqli_fetch_assoc($edit);

                                                                    // Fetch the list of maternal names
                                                                    $query = "SELECT DISTINCT CONCAT(fname, ' ', minitial, ' ', lname) AS fullname FROM maternal";
                                                                    $result = mysqli_query($con, $query);
                                                                    $options = [];
                                                                    if ($result) {
                                                                        while ($name_row = mysqli_fetch_assoc($result)) {
                                                                            $options[] = $name_row;
                                                                        }
                                                                        mysqli_free_result($result);
                                                                    }
                                                                    ?>


                                                                        <div>
                                                                            <input type="hidden" name="nutrition2_id"
                                                                                value="<?php echo $row['nutrition2_id']; ?>">
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Date of Registration:</label>
                                                                                <input name="reg_date" class="form-control form-control-sm" type="date"
                                                                                    value="<?php echo $row['reg_date']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Date of Birth:</label>
                                                                                <input name="birth_date" class="form-control form-control-sm"
                                                                                    type="date" value="<?php echo $row['birth_date']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-4">
                                                                                <div class="form-group">
                                                                            <label>Name of Child:</label>
                                                                            <input name="fname" type="text" class="form-control form-control-sm"
                                                                                value="<?php echo $row['fname']; ?>" 
                                                                                oninput="validateInput(this)">
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                                <div class="form-group">
                                                                            <label><br></label>
                                                                            <input name="minitial" type="text" class="form-control form-control-sm"
                                                                                value="<?php echo $row['minitial']; ?>" 
                                                                                oninput="validateInput(this)">
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                                <div class="form-group">
                                                                            <label><br></label>
                                                                            <input name="lname" type="text" class="form-control form-control-sm"
                                                                                value="<?php echo $row['lname']; ?>" 
                                                                                oninput="validateInput(this)">
                                                                        </div>
                                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Weight:<br></label>
                                                                                <input name="weight" class="form-control form-control-sm" type="number" min="0"
                                                                                    value="<?php echo max(0, $row['weight']); ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Height:<br></label>
                                                                                <input name="height" class="form-control form-control-sm" type="number" min="0"
                                                                                    value="<?php echo max(0, $row['height']); ?>">
                                                                            </div>
                                                                        </div>

                                                
                                                                        <div class="col-md-6">
                                                                            <label>Sex: </label>
                                                                            <div class="form-group">
                                                                                <div class="icheck-primary">
                                                                                    <input type="radio" name="sex" value="M" id="radioPrimary1"
                                                                                    <?php if ($row['sex'] == "M")
                                                                                        echo 'checked'; ?>>
                                                                                    <label for="radioPrimary1">
                                                                                        <span class="text" style="font-weight: normal;">
                                                                                            Male
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label><br></label>
                                                                            <div class="form-group">
                                                                                <div class="icheck-primary">
                                                                                    <input type="radio" name="sex" value="F" id="radioPrimary2"
                                                                                    <?php if ($row['sex'] == "F")
                                                                                        echo 'checked'; ?>>
                                                                                    <label for="radioPrimary2">
                                                                                        <span class="text" style="font-weight: normal;">
                                                                                            Female
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                <!--
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Sex:<br></label>
                                                                <select name="sex" class="form-control form-control-sm"
                                                                    style="width: 100%;" required>
                                                                    <option selected>
                                                                        <?php echo $row['sex']; ?>
                                                                    </option>
                                                                    <option value="M">M</option>
                                                                    <option value="F">F</option>
                                                                </select>
                                                            </div>
                                                        </div>
                -->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Name of Mother:</label>
                                                                <select name="selected_mother_name" id="mother_name" class="form-control form-control-sm" style="width: 100%;">
                                                                    <option selected><?php echo $row['mother_name']; ?></option>
                                                                    <?php
                                                                    foreach ($options as $name) {
                                                                        echo '<option value="' . $name['fullname'] . '">' . $name['fullname'] . '</option>';
                                                                    }
                                                                    ?>
                                                                    <option value="others">Other</option>
                                                                </select>
                                                                <input type="text" id="new_name_input" name="new_mother_name" class="form-control form-control-sm" 
                                                                style="display: none;" value="<?php echo $row['mother_name']; ?>">
                                                            </div>
                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Complete Address:<br></label>
                                                                                <select name="purok" class="form-control form-control-sm"
                                                                                    style="width: 100%;" required>
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
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label><br></label>
                                                                                <input name="address" class="form-control form-control-sm" type="text"
                                                                                    value="<?php echo $row['address']; ?>" readonly>
                                                                            </div>
                                                                        </div>
    
                                                        <!-- 6-11 months -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Age:<br></label>
                                                                <div class="icheck-primary">
                                                                    <input type="checkbox" id="checkbox1" value="✓" name="6to11mos"
                                                                    <?php if ($row['6to11mos'] == "✓")
                                                                        echo 'checked'; ?>>
                                                                    <label for="checkbox1">6-11 months</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- 12-59 months -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><br></label>
                                                                <div class="icheck-primary">
                                                                    <input type="checkbox" id="checkbox2" value="✓" name="12to59mos" 
                                                                    <?php if ($row['12to59mos'] == "✓")
                                                                        echo 'checked'; ?>>
                                                                    <label for="checkbox2">12-59 months</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker1" style="display: none;">
                                                                            <div style="text-align: center;">
                                                                                <label>Micronutrient Supplementation</label><br>
                                                                            </div>
                                                                                <label>Vitamin A:</label>
                                                                                <input name="vitamina" class="form-control form-control-sm" type="date"
                                                                                id="datepicker1_input" value="<?php echo $row['vitamina']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker2" style="display: none;">
                                                                                <label>Iron:</label>
                                                                                <input name="iron1" class="form-control form-control-sm" type="date"
                                                                                id="datepicker2_input" value="<?php echo $row['iron1']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker3" style="display: none;">
                                                                                <label>MNP:</label>
                                                                                <input name="mnp1" class="form-control form-control-sm" type="date"
                                                                                id="datepicker3_input" value="<?php echo $row['mnp1']; ?>">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker4" style="display: none;">
                                                                                <div style="text-align: center;">
                                                                                    <label>Micronutrient Supplementation</label><br>
                                                                                </div>
                                                                                <label>Vitamin A (Dose 1):</label>
                                                                                <input name="vitamin1" class="form-control form-control-sm" type="date"
                                                                                id="datepicker4_input" value="<?php echo $row['vitamin1']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker5" style="display: none;">
                                                                                <label>Vitamin A (Dose 2):</label>
                                                                                <input name="vitamin2" class="form-control form-control-sm" type="date"
                                                                                id="datepicker5_input" value="<?php echo $row['vitamin2']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker6" style="display: none;">
                                                                                <label>Iron:</label>
                                                                                <input name="iron2" class="form-control form-control-sm" type="date"
                                                                                id="datepicker6_input" value="<?php echo $row['iron2']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker7" style="display: none;">
                                                                                <label>MNP:</label>
                                                                                <input name="mnp2" class="form-control form-control-sm" type="date"
                                                                                id="datepicker7_input" value="<?php echo $row['mnp2']; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group" id="datepicker8" style="display: none;">
                                                                                <label>Deworming:</label>
                                                                                <input name="deworming" class="form-control form-control-sm" type="date"
                                                                                id="datepicker8_input" value="<?php echo $row['deworming']; ?>">
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
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <a href="../nutrition2/nutrition2.php">
                                                                            <button type="button" class="btn btn-default">Cancel</button>
                                                                        </a>
                                                                        <button type="submit" name="update" class="btn btn-primary">Update
                                                                            client</button>
                                                                    </div>

                                                            </form>

                                                            <?php
                                                            if (isset($_POST['update'])) {
                                                                $reg_date = $_POST['reg_date'];
                                                                $birth_date = $_POST['birth_date'];
                                                                $fname = $_POST['fname'];
                                                                $minitial = $_POST['minitial'];
                                                                $lname = $_POST['lname'];
                                                                $weight = $_POST['weight'];
                                                                $height = $_POST['height'];
                                                                $sex = $_POST['sex'];
                                                                $age1 = isset($_POST['6to11mos']) ? $_POST['6to11mos'] : '';
                                                                $age2 = isset($_POST['12to59mos']) ? $_POST['12to59mos'] : '';
                                                                if (isset($_POST['selected_mother_name']) && !empty($_POST['selected_mother_name']) && $_POST['selected_mother_name'] !== 'others') {
                                                                    $mother_name = $_POST['selected_mother_name'];
                                                                } elseif (isset($_POST['new_mother_name'])) {
                                                                    $mother_name = $_POST['new_mother_name'];
                                                                } else {
                                                                    die("Error: No mother name provided");
                                                                }
                                                                $purok = $_POST['purok'];
                                                                $address = $_POST['address'];
                                                                $vitamina = $_POST['vitamina'];
                                                                $vitamin1 = $_POST['vitamin1'];
                                                                $vitamin2 = $_POST['vitamin2'];
                                                                $iron1 = $_POST['iron1'];
                                                                $iron2 = $_POST['iron2'];
                                                                $mnp1 = $_POST['mnp1'];
                                                                $mnp2 = $_POST['mnp2'];
                                                                $deworming = $_POST['deworming'];
                                                                $remarks = $_POST['remarks'];
                                                                $remarks = mysqli_real_escape_string($con, $remarks);
                                                                $nid2 = $_GET['nid2'];

                                                                mysqli_query($con, "UPDATE nutrition2 SET reg_date='$reg_date', 
                                    birth_date='$birth_date', fname='$fname', 
                                    minitial='$minitial', lname='$lname', weight='$weight', height='$height',
                                    sex='$sex', 6to11mos='$age1', 12to59mos='$age2', mother_name='$mother_name', purok='$purok', address='$address', 
                                    vitamina='$vitamina', vitamin1='$vitamin1', vitamin2='$vitamin2', 
                                    iron1='$iron1', iron2='$iron2', mnp1='$mnp1', mnp2='$mnp2', 
                                    deworming='$deworming', remarks='$remarks' WHERE nutrition2_id = '$nid2'"); ?>

                                                                            <script type="text/javascript">
                                                                                alert("A client record has been updated.");
                                                                                window.location = "../nutrition2/nutrition2.php";
                                                                            </script>

                                                                            <?php
                                                            }

                                                            ?>


                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                            
                                                <div class="col-3">
                                                </div>

                                                </div>
                                        </div>
                                        </section>
                                    </div>
                                    </div>
                                    <!-- ./wrapper -->

                <script>
                    document.getElementById('mother_name').addEventListener('change', function() {
                        if (this.value === 'others') {
                            document.getElementById('new_name_input').style.display = 'block';
                            document.getElementById('new_name_input').setAttribute('required', 'required');
                        } else {
                            document.getElementById('new_name_input').style.display = 'none';
                            document.getElementById('new_name_input').removeAttribute('required');
                        }
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
                        
                        // disable date
                        const datePickers = document.querySelectorAll(".date-picker");

                        datePickers.forEach(function(datePicker) {
                            if (datePicker.value) {
                            datePicker.disabled = true;
                        }
                        });

                        $(document).ready(function () {
                            // Initialize iCheck checkboxes
                            $('input[type="checkbox"]').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                            });

                            // Function to show/hide date pickers based on checkbox state
                            function updateDatePickers() {
                                // Hide all date pickers by default
                                $('.datepicker-input').hide();

                                if ($('#checkbox1').is(':checked')) {
                                    $('#datepicker1').show();
                                    $('#datepicker2').show();
                                    $('#datepicker3').show();
                                    $('#datepicker4').hide();
                                    $('#datepicker5').hide();
                                    $('#datepicker6').hide();
                                    $('#datepicker7').hide();
                                    $('#datepicker8').hide();
                                }

                                if ($('#checkbox2').is(':checked')) {
                                    $('#datepicker1').hide();
                                    $('#datepicker2').hide();
                                    $('#datepicker3').hide();
                                    $('#datepicker4').show();
                                    $('#datepicker5').show();
                                    $('#datepicker6').show();
                                    $('#datepicker7').show();
                                    $('#datepicker8').show();
                                }
                            }

                            // Initial update of date pickers based on checkbox state
                            updateDatePickers();

                            // Handle Checkbox 1 change
                            $('#checkbox1').on('ifChanged', function () {
                                if (this.checked) {
                                    $('#checkbox2').iCheck('uncheck'); // Uncheck Checkbox 2
                                }
                                updateDatePickers();
                            });

                            // Handle Checkbox 2 change
                            $('#checkbox2').on('ifChanged', function () {
                                if (this.checked) {
                                    $('#checkbox1').iCheck('uncheck'); // Uncheck Checkbox 1
                                }
                                updateDatePickers();
                            });

                            // Initialize Date Pickers
                            $('.datepicker-input').datepicker();
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