<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
    if ($_SESSION['type'] == "Barangay Health Worker") {
        ?>

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

<div class="modal fade" id="add-client" style="font-family: Helvetica;">
    <form method="post">
        <div class="modal-dialog modal-xl">
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
                                <input name="sick_children_id" type="hidden">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Registration: <code class="text-danger">*</code></label>
                                    <input name="reg_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Registration" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <label>Name of Child: <code class="text-danger">*</code></label>
                                <input name="fname" type="text" class="form-control form-control-sm"
                                    placeholder="First Name" oninput="validateInput(this)" required>
                            </div>
                            <div class="col-2">
                                <label><br></label>
                                <input name="minitial" type="text" class="form-control form-control-sm"
                                    placeholder="Middle Initial"oninput="validateInput(this)">
                            </div>
                            <div class="col-2">
                                <label><br></label>
                                <input name="lname" type="text" class="form-control form-control-sm"
                                    placeholder="Last Name" oninput="validateInput(this)" required>
                            </div>

                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth: <code class="text-danger">*</code></label>
                                    <input name="birth_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Birth" required>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Complete Name of Mother:</label>
                                    <input name="mother_name" class="form-control form-control-sm" type="text"
                                        placeholder="First Name, Middle Initial, Last Name"
                                        oninput="validateInput(this)">
                                </div>
                            </div>

                            <div class="col-md-3"> 
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="address" class="form-control form-control-sm" type="text"
                                        value="Maharlika East, Tagaytay City" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <label><br></label>
                                <div class="form-group">
                                    <label>SE Status:</label>
                                    <select name="se_status" class="form-control form-control-sm" style="width: 100%;">
                                        <option selected disabled value="">Select Status</option>
                                        <option value="1">1. NHTS</option>
                                        <option value="2">2. Non-NHTS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Vitamin A Supplementation</label>
                                <div class="form-group">
                                    <label>Age:<br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="vitamin_6to11mos" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                        <span class="text">6-11 months</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                            <label><br></label>
                                <div class="form-group">
                                    <label><br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="vitamin_12to59mos" id="todoCheck4">
                                    <label for="todoCheck4"></label>
                                        <span class="text">12-59 months</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Diagnosis/Findings:</label>
                                    <input name="diagnosis" class="form-control form-control-sm" type="text"
                                        placeholder="(Use Code)">
                                </div>
                        </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date Given:</label>
                                    <input name="vitamin_supplementation_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <label>Diarrhea Treatment</label>
                                <div class="form-group ">
                                    <label>Age:</label>
                                    <input name="diarrhea_age" class="form-control form-control-sm" type="number"
                                        placeholder="Age in months">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label><br></label>
                                <div class="form-group">
                                    <label>ORS (Date Given):</label>
                                    <input name="diarrhea_ors_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date Given">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><br></label>
                                <div class="form-group">
                                    <label>Oral Zinc Drops or Syrup (Date Given):</label>
                                    <input name="diarrhea_oralzinc_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                                <label>Pneumonia Treatment</label>
                                <div class="form-group ">
                                    <label>Age:</label>
                                    <input name="pneumonia_age" class="form-control form-control-sm" type="number"
                                        placeholder="Age in months">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><br></label>
                                <div class="form-group">
                                    <label>Date Given:</label>
                                    <input name="pneumonia_treatment_date" class="form-control form-control-sm"
                                        type="date" placeholder="Date Given">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label><br></label>
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
    $sick_children_id = $_POST['sick_children_id'];
    $reg_date = $_POST['reg_date'];
    $fname = $_POST['fname'];
    $minitial = $_POST['minitial'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth_date'];
    $sex = $_POST['sex'];
    $mother_name = $_POST['mother_name'];
    $purok = $_POST['purok'];
    $address = $_POST['address'];
    $se_status = $_POST['se_status'];
    $vitamin_6to11mos = $_POST['vitamin_6to11mos'];
    $vitamin_12to59mos = $_POST['vitamin_12to59mos'];
    $diagnosis = $_POST['diagnosis'];
    $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
    $diarrhea_age = $_POST['diarrhea_age'];
    $diarrhea_ors_date = $_POST['diarrhea_ors_date'];
    $diarrhea_oralzinc_date = $_POST['diarrhea_oralzinc_date'];
    $pneumonia_age = $_POST['pneumonia_age'];
    $pneumonia_treatment_date = $_POST['pneumonia_treatment_date'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    $sc_add = mysqli_query($con, "INSERT INTO sickchildren
    VALUES ('$sick_children_id', '$reg_date', '$fname', '$minitial', '$lname', '$birth_date', '$sex', '$mother_name', '$purok', 
    '$address', '$se_status', '$vitamin_6to11mos', '$vitamin_12to59mos', '$diagnosis', '$vitamin_supplementation_date', '$diarrhea_age', '$diarrhea_ors_date', 
    '$diarrhea_oralzinc_date', '$pneumonia_age', '$pneumonia_treatment_date', '$remarks')"); 


    if ($sc_add) { ?>
        <script type="text/javascript">
            alert("A new client has been added.");
            window.location = "../sickchildren/sickchildren.php";
        </script>
    <?php }
}
?>
    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>