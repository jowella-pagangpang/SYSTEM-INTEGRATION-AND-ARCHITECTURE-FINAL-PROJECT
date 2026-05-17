<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
    if ($_SESSION['type'] == "Barangay Health Worker") {
        ?>

<head>
<style>
    .form-control:focus {
        border-color: #007bff; /* Change to the desired highlight color */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
        outline: none; /* Remove the default focus outline if needed */
    }

    #prenatalDiv {
        display: none;
    }
    #ttDiv {
        display: none;
    }
    #ironDiv {
        display: none;
    }
    #stiDiv {
        display: none;
    }
    #pregDiv {
        display: none;
    }
    #liveDiv {
        display: none;
    }
    </style>


<script>
function validateInput(inputElement) {
    let inputValue = inputElement.value;
    let lettersOnly = inputValue.replace(/[^a-zA-Z\s.-]/g, '');

    if (inputValue !== lettersOnly) {
        let selectionStart = inputElement.selectionStart;
        let selectionEnd = inputElement.selectionEnd;

        inputElement.value = lettersOnly;

        // Restore cursor position
        inputElement.setSelectionRange(selectionStart, selectionEnd);
    }
}
</script>
</head>

<?php
            $id = $_GET['id'];
            $data = mysqli_query($con, "SELECT * FROM client WHERE id = '$id'");
            $row = mysqli_fetch_assoc($data);
    ?>

<div class="modal fade" id="add-client" style="font-family: Helvetica;">
    <form method="post" id="ironForm" action="maternal-insert.php">
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
                            <input name="maternal_id" type="hidden">
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
                                    <label>LMP:</label>
                                    <input name="lmp" class="form-control form-control-sm" type="date"
                                        placeholder="LMP">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>G (gravida):</label>
                                    <input name="g" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="G">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>P (parity):</label>
                                    <input name="p" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="P">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>EDC:</label>
                                    <input name="edc" class="form-control form-control-sm" type="date"
                                        placeholder="EDC">
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                    <label>Maternal Care Service</label>
                                    <div class="form-group">
                                        <select name="maternal" id="maternal" class="form-control form-control-sm"
                                            style="width: 100%;">
                                            <option selected disabled value="">Select Service</option>
                                            <option value="prenatal">Prenatal Visits</option>
                                            <option value="tt">Date Tetanus Toxoid Vaccine Given</option>
                                            <option value="iron">Micronutrient Supplementation</option>
                                            <option value="sti">STI Surveillance</option>
                                            <option value="preg">Pregnancy</option>
                                            <option value="live">Livebirths</option>
                                        </select>
                                    </div>
                                </div>


                <div id="prenatalDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Prenatal Visits</label><br>
                    </div>
                    <div class="row">
                        <div class="col-6">
                                <div class="form-group">
                                    <label>First Trimester:</label>
                                    <input name="trimester1" type="date" class="form-control form-control-sm"
                                        placeholder="First Trimester">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="trimester1a" type="date" class="form-control form-control-sm"
                                        placeholder="First Trimester">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Second Trimester:</label>
                                    <input name="trimester2" type="date" class="form-control form-control-sm"
                                        placeholder="Second Trimester">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="trimester2a" type="date" class="form-control form-control-sm"
                                        placeholder="Second Trimester">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Third Trimester:</label>
                                    <input name="trimester3" type="date" class="form-control form-control-sm"
                                        placeholder="Third Trimester">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="trimester3a" type="date" class="form-control form-control-sm"
                                        placeholder="Third Trimester">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                <div id="ttDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Date Tetanus Toxoid Vaccine Given</label><br>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tetanus Status:</label>
                                    <select name="tetanus_status" class="form-control form-control-sm"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select Tetanus Status</option>
                                        <option value="TT1">TT1</option>
                                        <option value="TT2">TT2</option>
                                        <option value="TT3">TT3</option>
                                        <option value="TT4">TT4</option>
                                        <option value="TT5">TT5</option>
                                        <option value="TTL">TTL</option>
                                        <option value="NONE">NONE</option>
                                        <option value="UNKNOWN">UNKNOWN</option>
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>TT1:</label>
                                    <input name="tt1date" type="date" class="form-control form-control-sm"
                                        placeholder="TT1">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>TT2:</label>
                                    <input name="tt2date" type="date" class="form-control form-control-sm"
                                        placeholder="TT2">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>TT3:</label>
                                    <input name="tt3date" type="date" class="form-control form-control-sm"
                                        placeholder="TT3">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>TT4:</label>
                                    <input name="tt4date" type="date" class="form-control form-control-sm"
                                        placeholder="TT4">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>TT5:</label>
                                    <input name="tt5date" type="date" class="form-control form-control-sm" 
                                        placeholder="TT5">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="ironDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Date and Number Iron with Folic Acid was given</label>
                    </div><br>
                    <div class="row" id="formFields">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input name="iron1date" class="form-control form-control-sm" type="date"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Number:</label>
                                    <input name="1datenumber" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="No.">
                                </div>
                            </div>
                            
        <div class="col-md-1">
            <div class="form-group">
            <label><br></label>
                <button type="button" class="btn btn-primary btn-xs" id="addButton">
                <i class="nav-icon fas fa-plus"></i></button>
            </div>
        </div>
                        </div>
                    </div>


                    <div id="stiDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>STI Surveillance</label><br>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tested for SY:</label>
                                    <input name="sydate" class="form-control form-control-sm" type="date"
                                        placeholder="SY Date">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Result for SY Testing:</label>
                                    <select name="syresult" class="form-control form-control-sm" style="width: 100%;">
                                        <option selected disabled value="">(+/-)</option>
                                        <option value="(+)">(+)</option>
                                        <option value="(-)">(-)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input name="syresult_date" class="form-control form-control-sm" type="date"
                                        placeholder="Result Date">
                                </div>
                            </div>

                        <div class="col-md-5">
                                <div class="form-group">
                                    <label>Given Penicillin:</label>
                                    <select name="given_penicillin" class="form-control form-control-sm"
                                        style="width: 100%;">
                                        <option selected disabled value="">Y/N</option>
                                        <option value="Y">Y</option>
                                        <option value="N">N</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input name="given_penicillin_date" class="form-control form-control-sm" type="date"
                                        placeholder="Given Date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pregDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Pregnancy</label><br>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Terminated:</label>
                                    <input name="date_terminated" class="form-control form-control-sm" type="date"
                                        placeholder="Date Terminated">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Outcome:</label>
                                    <select name="outcome" class="form-control form-control-sm" style="width: 100%;">
                                        <option selected disabled value="">Pregnancy Outcome</option>
                                        <option value="LB">LB = Livebirth</option>
                                        <option value="FD">FD = Fetal Death</option>
                                        <option value="AB">AB = Abortion</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <label>Gender:</label>
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="radio" name="gender" value="M" id="radioPrimary1">
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
                                            <input type="radio" name="gender" value="F" id="radioPrimary2">
                                            <label for="radioPrimary2">
                                                <span class="text" style="font-weight: normal;">
                                                    Female
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="liveDiv" class="col-md-12">
                    <div style="text-align: center;">
                        <label>Livebirths</label><br>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Birth weight (grams):</label>
                                    <input name="birth_weight" class="form-control form-control-sm" type="number" min="0"
                                        placeholder="Grams">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Health Facility:</label>
                                    <input name="facility" type="text" class="form-control form-control-sm"
                                        placeholder="Place of Health Facility" oninput="validateInput(this)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Non-Institutional Delivery (NID):</label>
                                    <input name="nid" type="text" class="form-control form-control-sm"
                                        placeholder="Place of Non-Institutional Delivery" oninput="validateInput(this)">
                                </div>
                            </div>
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Attended by:</label>
                                    <select name="attended" class="form-control form-control-sm"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select Code</option>
                                        <option value="MD">MD = Doctor</option>
                                        <option value="RN">RN = Nurse</option>
                                        <option value="RM">RM = Midwife</option>
                                        <option value="H">H = Hilot/TBA</option>
                                        <option value="O">O = Others</option>
                                    </select>
                                </div>
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

    
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formFields = document.getElementById("formFields");
        const addButton = document.getElementById("addButton");
        let fieldNumber = 2; // Start with the 2nd date and number fields

        addButton.addEventListener("click", function () {
            if (fieldNumber <= 6) {
                const dateFieldName = `iron${fieldNumber}date`;
                const numberFieldName = `${fieldNumber}datenumber`;

                // Create a new set of date and number input fields with proper Bootstrap classes
                const newFields = document.createElement("div");
                newFields.classList.add("col-md-12"); // Use Bootstrap column class
                newFields.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date:</label>
                                <input name="${dateFieldName}" class="form-control form-control-sm" type="date" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-5"> <!-- Use col-md-5 here to match the column width -->
                            <div class="form-group">
                                <label>Number:</label>
                                <input name="${numberFieldName}" class="form-control form-control-sm" type="number" placeholder="No.">
                            </div>
                        </div>
                    </div>
                `;

                formFields.appendChild(newFields);
                fieldNumber++;

                // Hide the "Add" button after the 6th date field is added
                if (fieldNumber > 6) {
                    addButton.style.display = "none";
                }
            }
        });
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
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>