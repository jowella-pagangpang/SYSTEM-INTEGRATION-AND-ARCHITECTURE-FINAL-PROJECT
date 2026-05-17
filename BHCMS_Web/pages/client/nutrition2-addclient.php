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

        <?php
            $id = $_GET['id'];
            $data = mysqli_query($con, "SELECT * FROM client WHERE id = '$id'");
            $row = mysqli_fetch_assoc($data);
        ?>

    <div class="modal fade" id="add-client" style="font-family: Helvetica;">
        <form method="post" action="nutrition2-insert.php">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Add Record</h5>
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
                                        <label>Client ID:</label>
                                        <input name="patientid" class="form-control form-control-sm" type="number"
                                        value="<?php echo $id; ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date of Registration: <code class="text-danger">*</code></label>
                                        <input name="reg_date" class="form-control form-control-sm" type="date"
                                            placeholder="Date of Registration" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight (kg):<br></label>
                                        <input name="weight" class="form-control form-control-sm" type="number" min="0" step="0.01"
                                            placeholder="Weight">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Height (cm):<br></label>
                                        <input name="height" class="form-control form-control-sm" type="number" min="0"
                                            placeholder="Height">
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
                                            <label>Micronutrient Supplementation (Date Given)</label><br>
                                        </div>
                                        <br>
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
                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker9" style="display: none;">
                                        <label>Remarks</label>
                                        <textarea name="remarks1" class="form-control form-control-sm" rows="2"
                                        id="datepicker9_input" placeholder=""></textarea>
                                    </div>
                                </div>


                                <!-- 12-59 months -->
                                <div class="col-md-12">
                                    <div class="form-group" id="datepicker4" style="display: none;">
                                        <div style="text-align: center;">
                                            <label>Micronutrient Supplementation (Date Given)</label><br>
                                        </div><br>
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
                                    <div class="form-group" id="datepicker10" style="display: none;">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control form-control-sm" rows="2"
                                        id="datepicker10_input" placeholder=""></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary toastrDefaultSuccess">Add</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
        <!-- /.form -->
    </div>
    <!-- /.modal -->



<script>

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
                    $('#datepicker9').show();
                    $('#datepicker4').hide(); // Hide Date Picker 2 when Checkbox 1 is checked
                    $('#datepicker5').hide();
                    $('#datepicker6').hide();
                    $('#datepicker7').hide();
                    $('#datepicker8').hide();
                    $('#datepicker10').hide();
                    // Uncheck Checkbox 2
                    $('#checkbox2').iCheck('uncheck');
                } else {
                    $('#datepicker1').hide();
                    $('#datepicker2').hide();
                    $('#datepicker3').hide();
                    $('#datepicker9').hide();
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
                    $('#datepicker10').show();
                    $('#datepicker1').hide(); // Hide Date Picker 1 when Checkbox 2 is checked
                    $('#datepicker2').hide();
                    $('#datepicker3').hide();
                    $('#datepicker9').hide();
                    // Uncheck Checkbox 1
                    $('#checkbox1').iCheck('uncheck');
                } else {
                    $('#datepicker4').hide();
                    $('#datepicker5').hide();
                    $('#datepicker6').hide();
                    $('#datepicker7').hide();
                    $('#datepicker8').hide();
                    $('#datepicker10').hide();
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
            $('#datepicker9_input').datepicker();
            $('#datepicker10_input').datepicker();
        });

    </script>


<?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
} ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>