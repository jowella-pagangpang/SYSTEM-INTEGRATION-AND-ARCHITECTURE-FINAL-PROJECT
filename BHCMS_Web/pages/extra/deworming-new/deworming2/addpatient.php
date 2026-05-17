<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php
if ($_SESSION['type'] == "Barangay Health Worker") {
    ?>

    <div class="modal fade" id="add-patient" style="font-family: Helvetica;">
        <form method="post">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Add Patient Record</h5>
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

                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="service" class="form-control form-control-sm text-center" type="text"
                                        value="Deworming 5-9 years old" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Registration:</label>
                                    <input name="reg_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Registration" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth:</label>
                                    <input name="birth_date" class="form-control form-control-sm" type="date"
                                        placeholder="Date of Birth" required>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-2">
                                    <label>Name of Child:</label>
                                    <input name="fname" type="text" class="form-control form-control-sm"
                                        placeholder="First Name" required>
                                </div>
                                <div class="col-2">
                                    <label><br></label>
                                    <input name="minitial" type="text" class="form-control form-control-sm"
                                        placeholder="Middle Initial">
                                </div>
                                <div class="col-2">
                                    <label><br></label>
                                    <input name="lname" type="text" class="form-control form-control-sm"
                                        placeholder="Last Name" required>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sex:<br></label>
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
                                            placeholder="First Name, Middle Initial, Last Name">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Complete Address:<br></label>
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
                                    <div class="form-group">
                                        <label>Age:<br></label>
                                        <select name="age" class="form-control form-control-sm" style="width: 100%;"
                                            required>
                                            <option selected disabled value="">Select Age (5-9)</option>
                                            <option value="5 y/o">5 y/o</option>
                                            <option value="6 y/o">6 y/o</option>
                                            <option value="7 y/o">7 y/o</option>
                                            <option value="8 y/o">8 y/o</option>
                                            <option value="9 y/o">9 y/o</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>1st Dose (date given):</label>
                                        <input name="1stdose" class="form-control form-control-sm" type="date"
                                            placeholder="1st Dose">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>2nd Dose (date given):</label>
                                        <input name="2nddose" class="form-control form-control-sm" type="date"
                                            placeholder="2nd Dose">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control form-control-sm" rows="1"
                                            placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary toastrDefaultSuccess">Add new
                            patient</button>
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

        $deworming2add = mysqli_query($con, "INSERT INTO deworming
    VALUES ('$deworming_id', '$service', '$reg_date', '$birth_date', '$fname', '$minitial', '$lname', '$sex', '$mother_name', '$purok', 
    '$address', '$age', '$first', '$second', '$remarks')");


        if ($deworming2add) { ?>
            <script type="text/javascript">
                alert("A new patient has been added.");
                window.location = "../deworming2/deworming5-9.php";
            </script>
        <?php }
    }
    ?>

<?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
} ?>


<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>