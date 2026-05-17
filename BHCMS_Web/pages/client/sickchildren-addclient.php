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
    <form method="post" action="sickchildren-insert.php">
        <div class="modal-dialog modal-defau;t">
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
                                <input name="sick_children_id" type="hidden">
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

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>SE Status:</label>
                                    <select name="se_status" class="form-control form-control-sm" style="width: 100%;">
                                        <option selected disabled value="">Select Status</option>
                                        <option value="1">1. NHTS</option>
                                        <option value="2">2. Non-NHTS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                    <label>Supplementation and Treatment</label>
                                    <div class="form-group">
                                        <select name="treatment" id="treatment" class="form-control form-control-sm"
                                            style="width: 100%;">
                                            <option selected disabled value="">Select Supplementation and Treatment</option>
                                            <option value="vitamin">Vitamin A Supplementation</option>
                                            <option value="diar">Diarrhea Cases Seen and Given Treatment</option>
                                            <option value="pneu">Pneumonia Cases Seen and Given Treatment</option>
                                        </select>
                                    </div>
                                </div>

                        <div id="vitaminDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Vitamin A Supplementation</label><br>
                    </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age:<br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="vitamin_6to11mos" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                        <span class="text">6-11 months</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="vitamin_12to59mos" id="todoCheck4">
                                    <label for="todoCheck4"></label>
                                        <span class="text">12-59 months</span>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis/Findings:</label>
                                    <input name="diagnosis" class="form-control form-control-sm" type="text"
                                        placeholder="(Use Code)">
                                </div>
                        </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Given:</label>
                                    <input name="vitamin_supplementation_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks1" class="form-control form-control-sm" rows="2"
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="diarDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Diarrhea Cases Seen and Given Treatment</label><br>
                    </div>
                            <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input name="diarrhea_age" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="Age in months">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Date Given</label>
                                    <div class="form-group">
                                        <label>ORS:</label>
                                    <input name="diarrhea_ors_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date Given">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label><br></label>
                                    <div class="form-group">
                                        <label>Oral Zinc Drops or Syrup:</label>
                                    <input name="diarrhea_oralzinc_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks2" class="form-control form-control-sm" rows="2"
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pneuDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Pneumonia Cases Seen and Given Treatment</label><br>
                    </div>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input name="pneumonia_age" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="Age in months">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Given:</label>
                                    <input name="pneumonia_treatment_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>