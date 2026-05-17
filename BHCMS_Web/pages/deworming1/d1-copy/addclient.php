<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
    if ($_SESSION['type'] == "Barangay Health Worker") {
        ?>

<head>
<style>
#readonly-field {
  background-color: transparent;
  border: none;
}
.form-control:focus {
    border-color: #007bff; /* Change to the desired highlight color */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional box shadow effect */
    outline: none; /* Remove the default focus outline if needed */
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
                                <input name="deworming_id" type="hidden">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="service" class="form-control form-control-sm text-center font-weight-bold" type="hidden"
                                        id="readonly-field" value="Deworming 1-4 years old" readonly>
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
                                    <label>Date of Birth: <code class="text-danger">*</code></label>
                                    <input name="birth_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Birth" required>
                                </div>
                            </div>

                        <div class="col-4">
                                    <div class="form-group">
                                <label>Name of Child: <code class="text-danger">*</code></label>
                                <input name="fname" type="text" class="form-control form-control-sm"
                                    placeholder="First Name" oninput="validateInput(this)"required>
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
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Complete Name of Mother:</label>
                                    <input name="mother_name" class="form-control form-control-sm" 
                                    type="text" placeholder="First Name, Middle Initial, Last Name" 
                                    oninput="validateInput(this)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Complete Address: <code class="text-danger">*</code><br></label>
                                    <select name="purok" class="form-control form-control-sm"
                                        style="width: 100%;" required>
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

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Age: <code class="text-danger">*</code><br></label>
                                    <select name="age" class="form-control form-control-sm" style="width: 100%;"
                                        required>
                                        <option selected disabled value="">Select Age (1-4)</option>
                                        <option value="1 y/o">1 y/o</option>
                                        <option value="2 y/o">2 y/o</option>
                                        <option value="3 y/o">3 y/o</option>
                                        <option value="4 y/o">4 y/o</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Date Given</label>
                                    <div class="form-group">
                                        <label>1st Dose:</label>
                                    <input name="1stdose" class="form-control form-control-sm" type="date"
                                        placeholder="1st Dose">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label><br></label>
                                    <div class="form-group">
                                        <label>2nd Dose:</label>
                                    <input name="2nddose" class="form-control form-control-sm" type="date"
                                        placeholder="2nd Dose">
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
    $deworming_id = $_POST['deworming_id'];
    $service = $_POST['service'];
    $reg_date = $_POST['reg_date'];
    $birth_date = $_POST['birth_date'];
    $fname = $_POST['fname'];
    $minitial = $_POST['minitial'];
    $lname = $_POST['lname'];
    $sex = $_POST['sex'];
    $mother_name = $_POST['mother_name'];
    $purok = $_POST['purok'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $first = $_POST['1stdose'];
    $second = $_POST['2nddose'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    $deworming1add = mysqli_query($con, "INSERT INTO deworming
     (deworming_id, service, reg_date, birth_date, fname, minitial, lname, sex, mother_name, purok, 
    address, age, 1stdose, 2nddose, remarks) 
     VALUES ('$deworming_id', '$service', '$reg_date', '$birth_date', '$fname', '$minitial', '$lname', '$sex', '$mother_name', '$purok', 
    '$address', '$age', '$first', '$second', '$remarks')"); 


    if ($deworming1add) { ?>
        <script type="text/javascript">
            alert("A new client has been added.");
            window.location = "../deworming1/deworming1-4.php";
        </script>
    <?php }

}
?>
    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>