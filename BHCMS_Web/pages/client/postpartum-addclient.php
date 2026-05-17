<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
if ($_SESSION['type'] == "Barangay Health Worker") {
    ?>

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
    </script>

        <?php
            $id = $_GET['id'];
            $data = mysqli_query($con, "SELECT * FROM client WHERE id = '$id'");
            $row = mysqli_fetch_assoc($data);
        ?>

    <div class="modal fade" id="add-client" style="font-family: Helvetica;">
        <form method="post" action="postpartum-insert.php">
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
                                    <input name="postpartum_id" type="hidden">
                                </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client ID:</label>
                                        <input name="patientid" class="form-control form-control-sm" type="number"
                                        value="<?php echo $id; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date and Time of Delivery: <code class="text-danger">*</code><br></label>
                                        <input name="delivery_date" class="form-control form-control-sm" type="date"
                                            placeholder="Date of Delivery" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><br></label>
                                        <input name="delivery_time" class="form-control form-control-sm" type="text"
                                            placeholder="Time of Delivery">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date within 24 hours after delivery:</label>
                                        <input name="date_visit_24hr" class="form-control form-control-sm" type="date"
                                            placeholder="Date within 24 hours after delivery">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date within 1 week after delivery:</label>
                                        <input name="date_visit_1week" class="form-control form-control-sm" type="date"
                                            placeholder="Date within 1 week after delivery">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                        <label>Date and Time Initiated Breastfeeding:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="date_breastfeed" class="form-control form-control-sm" type="date" placeholder="Date Initiated Breastfeeding">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="time_breastfeed" class="form-control form-control-sm" type="text" placeholder="Time Initiated Breastfeeding">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>1st Date:<br></label>
                                                <input name="iron_supplementation_1stdate"
                                                    class="form-control form-control-sm" type="date"
                                                    placeholder="Iron Supplementation Date">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="1stdate_tablets" class="form-control form-control-sm"
                                                    type="number" placeholder="No. Tablets" min="0">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>2nd Date:<br></label>
                                                <input name="iron_supplementation_2nddate"
                                                    class="form-control form-control-sm" type="date"
                                                    placeholder="Iron Supplementation Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="2nddate_tablets" class="form-control form-control-sm"
                                                    type="number" placeholder="No. Tablets" min="0">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>3rd Date:<br></label>
                                                <input name="iron_supplementation_3rddate"
                                                    class="form-control form-control-sm" type="date"
                                                    placeholder="Iron Supplementation Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Tablets:<br></label>
                                                <input name="3rddate_tablets" class="form-control form-control-sm"
                                                    type="number" placeholder="No. Tablets" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="vitaminDiv" class="col-md-12">
                                    <div class="form-group">
                                        <label>Date:<br></label>
                                        <input name="vitamin_supplementation_date" class="form-control form-control-sm"
                                            type="date" placeholder="Iron Supplementation Date">
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


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>