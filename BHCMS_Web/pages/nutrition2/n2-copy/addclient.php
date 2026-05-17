<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
if ($_SESSION['type'] == "Barangay Health Worker") {
    ?>

<head>

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

    <div class="modal fade" id="add-client" style="font-family: Helvetica;">
        <form method="post">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Add Client Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container-fluid">
                            <div class="row">

                                <div>
                                    <input name="nutrition2_id" type="hidden">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date of Registration: <code class="text-danger">*</code></label>
                                        <input name="reg_date" class="form-control form-control-sm" type="date"
                                            placeholder="Date of Registration" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date of Birth: <code class="text-danger">*</code></label>
                                        <input name="birth_date" class="form-control form-control-sm" type="date"
                                            placeholder="Date of Birth" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Name of Child: <code class="text-danger">*</code></label>
                                        <input name="fname" type="text" class="form-control form-control-sm"
                                            placeholder="First Name" oninput="validateInput(this)" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label><br></label>
                                        <input name="minitial" type="text" class="form-control form-control-sm"
                                            placeholder="Middle Initial" oninput="validateInput(this)">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label><br></label>
                                        <input name="lname" type="text" class="form-control form-control-sm"
                                            placeholder="Last Name" oninput="validateInput(this)" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight:<br></label>
                                        <input name="weight" class="form-control form-control-sm" type="number" min="0"
                                            placeholder="Weight">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Height:<br></label>
                                        <input name="height" class="form-control form-control-sm" type="number" min="0"
                                            placeholder="Height">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Sex: <code class="text-danger">*</code><br></label>
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="radio" name="sex" value="M" id="radioPrimary1">
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
                                            <input type="radio" name="sex" value="F" id="radioPrimary2">
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
                                        <label>Sex: <code class="text-danger">*</code><br></label>
                                        <select name="sex" class="form-control form-control-sm" style="width: 100%;"
                                            required>
                                            <option selected disabled value="">Select Sex</option>
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                </div>
-->

                            <?php
                                $query = "SELECT DISTINCT CONCAT(fname, ' ', minitial, ' ', lname) AS fullname FROM maternal";
                                $result = mysqli_query($con, $query);
                                if ($result) {
                                    $options = [];
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $options[] = $row;
                                    }
                                    mysqli_free_result($result);
                                }
                            ?>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label>Name of Mother: <code class="text-danger">*</code><br></label>
                                <select name="selected_mother_name" id="mother_name" class="form-control form-control-sm" 
                                style="width: 100%;" required>
                                    <option selected disabled value="">Select Mother Name</option>
                                    <?php
                                        foreach ($options as $name) {
                                    ?>
                                    <option value="<?php echo $name['fullname']; ?>"><?php echo $name['fullname']; ?> </option>
                                    <?php
                                        }
                                    ?>
                                    <option value="others">Other</option>
                                </select>
                                <input type="text" id="new_name_input" name="new_mother_name" class="form-control form-control-sm" style="display: none;" placeholder="Enter Mother Name">
                            </div>
                        </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Complete Address: <code class="text-danger">*</code><br></label>
                                        <select name="purok" class="form-control form-control-sm" style="width: 100%;"
                                            required>
                                            <option selected disabled value="">Select Purok</option>
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
                                            value="Maharlika East, Tagaytay City" readonly>
                                    </div>
                                </div>

                                <!-- 6-11 months -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age:<br></label>
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="checkbox1" value="✓" name="6to11mos">
                                            <label for="checkbox1">6-11 months</label>
                                        </div>
                                    </div>
                                </div>


                                <!-- 12-59 months -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><br></label>
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="checkbox2" value="✓" name="12to59mos">
                                            <label for="checkbox2">12-59 months</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6-11 months -->
                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker1" style="display: none;">
                                        <div style="text-align: center;">
                                            <label>Micronutrient Supplementation</label><br>
                                        </div>
                                        <label>Vitamin A:</label>
                                        <input name="vitamina" class="form-control form-control-sm" type="date"
                                            id="datepicker1_input" placeholder="Vitamin A (6-11 months)">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker2" style="display: none;">
                                        <label>Iron:</label>
                                        <input name="iron1" class="form-control form-control-sm" type="date"
                                            id="datepicker2_input" placeholder="Iron (6-11 months)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker3" style="display: none;">
                                        <label>MNP:</label>
                                        <input name="mnp1" class="form-control form-control-sm" type="date"
                                            id="datepicker3_input" placeholder="MNP (6-11 months)">
                                    </div>
                                </div>


                                <!-- 12-59 months -->
                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker4" style="display: none;">
                                        <div style="text-align: center;">
                                            <label>Micronutrient Supplementation</label><br>
                                        </div>
                                        <label>Vitamin A (Dose 1):</label>
                                        <input name="vitamin1" class="form-control form-control-sm" type="date"
                                            id="datepicker4_input" placeholder="Vitamin A 12-59 months (Dose 1)">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker5" style="display: none;">
                                        <label>Vitamin A (Dose 2):</label>
                                        <input name="vitamin2" class="form-control form-control-sm" type="date"
                                            id="datepicker5_input" placeholder="Vitamin A 12-59 months (Dose 2)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker6" style="display: none;">
                                        <label>Iron:</label>
                                        <input name="iron2" class="form-control form-control-sm" type="date"
                                            id="datepicker6_input" placeholder="Iron (12-59 months)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker7" style="display: none;">
                                        <label>MNP:</label>
                                        <input name="mnp2" class="form-control form-control-sm" type="date"
                                            id="datepicker7_input" placeholder="MNP (12-23 months)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker8" style="display: none;">
                                        <label>Deworming:</label>
                                        <input name="deworming" class="form-control form-control-sm" type="date"
                                            id="datepicker8_input" placeholder="Deworming (12-59 months)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control form-control-sm" rows="2"
                                            placeholder=""></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary toastrDefaultSuccess">Add new
                            client</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
        <!-- /.form -->
    </div>
    <!-- /.modal -->


    <?php

    if (isset($_POST['submit'])) {
        $nutrition2_id = $_POST['nutrition2_id'];
        $reg_date = $_POST['reg_date'];
        $birth_date = $_POST['birth_date'];
        $fname = $_POST['fname'];
        $minitial = $_POST['minitial'];
        $lname = $_POST['lname'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $sex = $_POST['sex'];
        $age1 = isset($_POST['6to11mos']) ? $_POST['6to11mos'] : ''; // Check if 6to11mos checkbox is checked
        $age2 = isset($_POST['12to59mos']) ? $_POST['12to59mos'] : ''; // Check if 12to59mos checkbox is checked
        if (isset($_POST['selected_mother_name']) && $_POST['selected_mother_name'] !== 'others') {
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

        $addnutrition2 = mysqli_query($con, "INSERT INTO nutrition2 VALUES ('$nutrition2_id', '$reg_date', '$birth_date', '$fname', '$minitial', '$lname', 
    '$weight', '$height', '$sex', '$age1', '$age2', '$mother_name', '$purok', '$address', '$vitamina', '$vitamin1', '$vitamin2', 
    '$iron1', '$iron2', '$mnp1', '$mnp2', '$deworming', '$remarks')") or die('Error: ' . mysqli_error($con));


        if ($addnutrition2) { ?>
            <script type="text/javascript">
                alert("A new client has been added.");
                window.location = "../nutrition2/nutrition2.php";
            </script>
        <?php }

    }
    ?>


<script>

// add new mother name
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('mother_name').addEventListener('change', function () {
            if (this.value === 'others') {
                document.getElementById('new_name_input').style.display = 'block';
                document.getElementById('new_name_input').setAttribute('required', 'required');
            } else {
                document.getElementById('new_name_input').style.display = 'none';
                document.getElementById('new_name_input').removeAttribute('required');
            }
        });
    });
// letters in input
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

// checkbox option
        $(document).ready(function () {
            // Initialize iCheck checkboxes
            $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });

            // Handle Checkbox 1
            $('#checkbox1').on('ifChanged', function () {
                if (this.checked) {
                    $('#datepicker1').show();
                    $('#datepicker2').show();
                    $('#datepicker3').show();
                    $('#datepicker4').hide(); // Hide Date Picker 2 when Checkbox 1 is checked
                    $('#datepicker5').hide();
                    $('#datepicker6').hide();
                    $('#datepicker7').hide();
                    $('#datepicker8').hide();
                    // Uncheck Checkbox 2
                    $('#checkbox2').iCheck('uncheck');
                } else {
                    $('#datepicker1').hide();
                    $('#datepicker2').hide();
                    $('#datepicker3').hide();
                }
            });

            // Handle Checkbox 2
            $('#checkbox2').on('ifChanged', function () {
                if (this.checked) {
                    $('#datepicker4').show();
                    $('#datepicker5').show();
                    $('#datepicker6').show();
                    $('#datepicker7').show();
                    $('#datepicker8').show();
                    $('#datepicker1').hide(); // Hide Date Picker 1 when Checkbox 2 is checked
                    $('#datepicker2').hide();
                    $('#datepicker3').hide();
                    // Uncheck Checkbox 1
                    $('#checkbox1').iCheck('uncheck');
                } else {
                    $('#datepicker4').hide();
                    $('#datepicker5').hide();
                    $('#datepicker6').hide();
                    $('#datepicker7').hide();
                    $('#datepicker8').hide();
                }
            });

            // Initialize Date Pickers
            $('#datepicker1_input').datepicker();
            $('#datepicker2_input').datepicker();
            $('#datepicker3_input').datepicker();
            $('#datepicker4_input').datepicker();
            $('#datepicker5_input').datepicker();
            $('#datepicker6_input').datepicker();
            $('#datepicker7_input').datepicker();
            $('#datepicker8_input').datepicker();
        });

    </script>


<?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
} ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>