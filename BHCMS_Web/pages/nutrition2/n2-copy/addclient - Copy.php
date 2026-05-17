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
                                <input name="nutrition2_id" type="hidden">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Registration: <code class="text-danger">*</code></label>
                                    <input name="reg_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Registration" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth: <code class="text-danger">*</code></label>
                                    <input name="birth_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Birth" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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

                            <div class="col-md-3">
                                <div class="form-group"> 
                                    <label>Weight:<br></label> 
                                    <input name="weight" class="form-control form-control-sm" type="number" 
                                        placeholder="Weight">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group"> 
                                    <label>Height:<br></label> 
                                    <input name="height" class="form-control form-control-sm" type="number" 
                                        placeholder="Height"> 
                                </div>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Age:<br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="6to11mos" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                        <span class="text">6-11 months</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><br></label>
                                    <div class="icheck-primary">
                                    <input type="checkbox" value="✓" name="12to59mos" id="todoCheck4">
                                    <label for="todoCheck4"></label>
                                        <span class="text">12-59 months</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Complete Name of Mother:</label>
                                    <input name="mother_name" class="form-control form-control-sm" type="text"
                                        placeholder="First Name, Middle Initial, Last Name"
                                        oninput="validateInput(this)">
                                </div>
                            </div>
                        </div>

                        <div class="row">
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vitamin A (6-11 months):</label>
                                    <input name="vitamina" class="form-control form-control-sm" type="date"
                                        placeholder="Vitamin A (6-11 months)">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vitamin A 12-59 months (Dose 1):</label>
                                    <input name="vitamin1" class="form-control form-control-sm" type="date"
                                        placeholder="Vitamin A 12-59 months (Dose 1)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vitamin A 12-59 months (Dose 2):</label>
                                    <input name="vitamin2" class="form-control form-control-sm" type="date"
                                        placeholder="Vitamin A 12-59 months (Dose 2)">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Iron (6-11 months):</label>
                                    <input name="iron1" class="form-control form-control-sm" type="date"
                                        placeholder="Iron (6-11 months)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Iron (12-59 months):</label>
                                    <input name="iron2" class="form-control form-control-sm" type="date"
                                        placeholder="Iron (12-59 months)">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>MNP (6-11 months):</label>
                                    <input name="mnp1" class="form-control form-control-sm" type="date"
                                        placeholder="MNP (6-11 months)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>MNP (12-23 months):</label>
                                    <input name="mnp2" class="form-control form-control-sm" type="date"
                                        placeholder="MNP (12-23 months)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deworming (12-59 months):</label>
                                    <input name="deworming" class="form-control form-control-sm" type="date"
                                        placeholder="Deworming (12-59 months)">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
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
    $age1 = $_POST['6to11mos'];
    $age2 = $_POST['12to59mos'];
    $mother_name = $_POST['mother_name'];
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

    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>