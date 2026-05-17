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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date and Time of Delivery: <code class="text-danger">*</code><br></label>
                                    <input name="delivery_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Delivery" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="delivery_time" class="form-control form-control-sm" type="text"
                                        placeholder="Time of Delivery">
                                </div>
                            </div>

                            <div class="col-2">
                                <label>Name: <code class="text-danger">*</code></label>
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
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputaddress">Address: <code class="text-danger">*</code><br></label>
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date within 24 hours after delivery:</label>
                                    <input name="date_visit_24hr" class="form-control form-control-sm" type="date"
                                        placeholder="Date within 24 hours after delivery">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date within 1 week after delivery:</label>
                                    <input name="date_visit_1week" class="form-control form-control-sm" type="date"
                                        placeholder="Date within 1 week after delivery">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Initiated Breastfeeding:<br></label>
                                    <input name="date_breastfeed" class="form-control form-control-sm" type="date"
                                        placeholder="Date Initiated Breastfeeding">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Time Initiated Breastfeeding:<br></label>
                                    <input name="time_breastfeed" class="form-control form-control-sm" type="text"
                                        placeholder="Time Initiated Breastfeeding">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Iron Supplementation Date:<br></label>
                                    <input name="iron_supplementation_1stdate" class="form-control form-control-sm"
                                        type="date" placeholder="Iron Supplementation Date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Number of Tablets:<br></label>
                                    <input name="1stdate_tablets" class="form-control form-control-sm" type="number"
                                        placeholder="No. Tablets">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>Iron Supplementation Date:<br></label>
                                    <input name="iron_supplementation_2nddate" class="form-control form-control-sm"
                                        type="date" placeholder="Iron Supplementation Date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Number of Tablets:<br></label>
                                    <input name="2nddate_tablets" class="form-control form-control-sm" type="number"
                                        placeholder="No. Tablets">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Iron Supplementation Date:<br></label>
                                    <input name="iron_supplementation_3rddate" class="form-control form-control-sm"
                                        type="date" placeholder="Iron Supplementation Date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Number of Tablets:<br></label>
                                    <input name="3rddate_tablets" class="form-control form-control-sm" type="number"
                                        placeholder="No. Tablets">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vitamin A Supplementation Date:<br></label>
                                    <input name="vitamin_supplementation_date" class="form-control form-control-sm"
                                        type="date" placeholder="Iron Supplementation Date">
                                </div>
                            </div>
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
    $delivery_date = $_POST['delivery_date'];
    $delivery_time = $_POST['delivery_time'];
    $fname = $_POST['fname'];
    $minitial = $_POST['minitial'];
    $lname = $_POST['lname'];
    $purok = $_POST['purok'];
    $address = $_POST['address'];
    $date_visit_24hr = $_POST['date_visit_24hr'];
    $date_visit_1week = $_POST['date_visit_1week'];
    $date_breastfeed = $_POST['date_breastfeed'];
    $time_breastfeed = $_POST['time_breastfeed'];
    $iron_supplementation_1stdate = $_POST['iron_supplementation_1stdate'];
    $firstdate_tablets = $_POST['1stdate_tablets'];
    $iron_supplementation_2nddate = $_POST['iron_supplementation_2nddate'];
    $seconddate_tablets = $_POST['2nddate_tablets'];
    $iron_supplementation_3rddate = $_POST['iron_supplementation_3rddate'];
    $thirddate_tablets = $_POST['3rddate_tablets'];
    $vitamin_supplementation_date = $_POST['vitamin_supplementation_date'];
    $remarks = $_POST['remarks'];
    $remarks = mysqli_real_escape_string($con, $remarks);

    $addpostpartum = mysqli_query($con, "INSERT INTO postpartum
    (delivery_date, delivery_time, fname, minitial, lname, purok, address, date_visit_24hr, date_visit_1week, 
    date_breastfeed, time_breastfeed, iron_supplementation_1stdate, 1stdate_tablets, iron_supplementation_2nddate, 
    2nddate_tablets, iron_supplementation_3rddate, 3rddate_tablets, vitamin_supplementation_date, remarks)
    VALUES ('$delivery_date', '$delivery_time', '$fname', '$minitial', '$lname', '$purok', 
    '$address', '$date_visit_24hr', '$date_visit_1week', '$date_breastfeed', '$time_breastfeed', 
    '$iron_supplementation_1stdate', '$firstdate_tablets', '$iron_supplementation_2nddate', '$seconddate_tablets', 
    '$iron_supplementation_3rddate', '$thirddate_tablets', '$vitamin_supplementation_date', '$remarks')") or die('Error: ' . mysqli_error($con));


    if ($addpostpartum) { ?>
        <script type="text/javascript">
            alert("A new client has been added.");
            window.location = "../postpartum/postpartum.php";
        </script>
    <?php }
}
?>

    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
      header("Location: ../../index.php"); } ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>