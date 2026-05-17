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

<?php
            $id = $_GET['id'];
            $data = mysqli_query($con, "SELECT * FROM client WHERE id = '$id'");
            $row = mysqli_fetch_assoc($data);
    ?>

<div class="modal fade" id="add-consult" style="font-family: Helvetica;">
    <form method="post" action="insert-consult.php">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Add Consultation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="row">

                        <div>
                            <input name="consult_id" type="hidden">
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Client ID:</label>
                                <input name="patientid" class="form-control form-control-sm"
                                    type="number" value="<?php echo $id; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date" style="font-size: 15px;">Date: <?php echo date("m-d-Y"); ?></label>
                                <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
            

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight (kg):</label>
                                <input name="weight" class="form-control form-control-sm"
                                    type="number" min="0" placeholder="Weight">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Height (cm):</label>
                                <input name="height" class="form-control form-control-sm"
                                    type="number" min="0" placeholder="Height">
                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Diagnosis:</label>
                            <textarea name="diagnosis" class="form-control form-control-sm" 
                            rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Treatment:</label>
                            <textarea name="treatment" class="form-control form-control-sm" 
                            rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea name="remarks" class="form-control form-control-sm" 
                            rows="2"></textarea>
                        </div>
                    </div>
                     

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitBtn" name="submit" class="btn btn-primary toastrDefaultSuccess">Add</button>
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
        // Disable the "Add" button initially
        document.getElementById("submitBtn").disabled = true;

        // Add an event listener to the form inputs for input changes
        document.querySelectorAll(".form-control").forEach(function (input) {
            input.addEventListener("input", function () {
                // Check if at least one input field is not empty
                var isAnyInputNotEmpty = Array.from(document.querySelectorAll(".form-control"))
                    .some(function (input) {
                        return input.value.trim() !== "";
                    });

                // Enable or disable the "Add" button based on the input
                document.getElementById("submitBtn").disabled = !isAnyInputNotEmpty;
            });
        });
    });

</script>
    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>