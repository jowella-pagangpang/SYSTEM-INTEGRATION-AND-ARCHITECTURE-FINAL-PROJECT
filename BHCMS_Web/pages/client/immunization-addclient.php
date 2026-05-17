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

        .icheck-primary label::before {
            text-align: justify;
        }

        #bcgDiv {
            display: none;
        }

        #hepaDiv {
            display: none;
        }

        #pentaDiv {
            display: none;
        }

        #opvDiv {
            display: none;
        }

        #pcvDiv {
            display: none;
        }

        #ipvDiv {
            display: none;
        }

        #mmrDiv {
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
        <form method="post" action="immunization-insert.php">
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
                                    <input name="immunization_id" type="hidden">
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
                              

                                <div class="col-md-6">
                                    <label>Child Protected at Birth (CPAB): </label>
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="cpab1" value="✓" id="todoCheck3">
                                            <label for="todoCheck3">
                                                <span class="text" style="font-weight: normal;">
                                                    TT2/Td2
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label><br></label>
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="cpab2" value="✓" id="todoCheck4">
                                            <label for="todoCheck4">
                                                <span class="text" style="font-weight: normal;">
                                                    TT3/Td3 to TT5/Td5 <br>(or TT1/Td1 to TT5/Td5) 
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Length at Birth:</label>
                                        <input name="length" class="form-control form-control-sm" type="number" min="0"
                                            placeholder="(cm)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight at Birth:</label>
                                        <input name="weight" class="form-control form-control-sm" type="number" min="0" step="0.01"
                                            placeholder="(kg)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status (Birth Weight):<br></label>
                                        <select name="birth_weight_status" class="form-control form-control-sm"
                                            style="width: 100%;">
                                            <option selected disabled value="">Select status</option>
                                            <option value="L">L: low (<2,500 gms)</option>
                                            <option value="N">N: normal (>2,500 gms)</option>
                                            <option value="U">U: unknown</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Initiated Breastfeed:</label>
                                        <input name="initiated_breastfeed" class="form-control form-control-sm" type="date"
                                            placeholder="Initiated Breastfeed">
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

        const immunizationSelect = document.getElementById('immunization');
        const bcgDiv = document.getElementById('bcgDiv');
        const hepaDiv = document.getElementById('hepaDiv');
        const pentaDiv = document.getElementById('pentaDiv');
        const opvDiv = document.getElementById('opvDiv');
        const pcvDiv = document.getElementById('pcvDiv');
        const ipvDiv = document.getElementById('ipvDiv');
        const mmrDiv = document.getElementById('mmrDiv');


        immunizationSelect.addEventListener('change', function () {
            if (immunizationSelect.value === 'bcg') {
                bcgDiv.style.display = 'block';
            } else {
                bcgDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'hepab') {
                hepaDiv.style.display = 'block';
            } else {
                hepaDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'penta') {
                pentaDiv.style.display = 'block';
            } else {
                pentaDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'opv') {
                opvDiv.style.display = 'block';
            } else {
                opvDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'pcv') {
                pcvDiv.style.display = 'block';
            } else {
                pcvDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'ipv') {
                ipvDiv.style.display = 'block';
            } else {
                ipvDiv.style.display = 'none';
            }

            if (immunizationSelect.value === 'mmr') {
                mmrDiv.style.display = 'block';
            } else {
                mmrDiv.style.display = 'none';
            }
        });
    </script>

<?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
} ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>