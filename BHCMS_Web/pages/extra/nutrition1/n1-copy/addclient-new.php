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

              #ttdateDiv {
                display: none;
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
              #ipvDiv {
                display: none;
              }
              #mcvDiv {
                display: none;
              }
              #firstDiv {
                display: none;
              }
              #secondDiv {
                display: none;
              }
              #thirdDiv {
                display: none;
              }
              #fourthDiv {
                display: none;
              }
              #fifthDiv {
                display: none;
              }
              #sixthDiv {
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
                                    <input name="nutrition1_id" type="hidden">
                                </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date of Registration: <code class="text-danger">*</code></label>
                                            <input name="reg_date" class="form-control form-control-sm" type="date"
                                                placeholder="Date of Registration" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
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
                                                placeholder="First Name" oninput="validateInput(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label><br></label>
                                            <input name="minitial" type="text" class="form-control form-control-sm"
                                                placeholder="Middle Initial"oninput="validateInput(this)">
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
                                        <div class="form-group">
                                            <label>Weight:<br></label>
                                            <input name="weight" class="form-control form-control-sm" type="number" min="0"
                                                placeholder="Weight">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Height:<br></label>
                                            <input name="height" class="form-control form-control-sm" type="number" min="0"
                                                placeholder="Height">
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

                                <?php
                                $query = "SELECT DISTINCT CONCAT(fname, ' ', minitial, ' ', lname) AS fullname FROM maternal";
                                $result = mysqli_query($con, $query);
                                if ($result) {
                                    $options = [];
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $options[] = $row;
                                    }
                                    mysqli_free_result($result);
                                }
                            ?>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label>Name of Mother: <code class="text-danger">*</code><br></label>
                                <select name="selected_mother_name" id="mother_name" class="form-control form-control-sm" 
                                style="width: 100%;" required>
                                    <option selected disabled value="">Select Mother Name</option>
                                    <?php
                                        foreach ($options as $name) {
                                    ?>
                                    <option value="<?php echo $name['fullname']; ?>"><?php echo $name['fullname']; ?> </option>
                                    <?php
                                        }
                                    ?>
                                    <option value="others">Other</option>
                                </select>
                                <input type="text" id="new_name_input" name="new_mother_name" class="form-control form-control-sm" style="display: none;" placeholder="Enter Mother Name">
                            </div>
                        </div>

                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><br></label>
                                            <input name="address" class="form-control form-control-sm" type="text"
                                                value="Maharlika East, Tagaytay City" readonly>
                                        </div>
                                    </div>
                            
                                <div class="col-md-12">
                                    <label>Date Newborn Screening</label>
                                        <div class="form-group">
                                            <label>Done:</label>
                                            <input name="screening_done" class="form-control form-control-sm" type="date"
                                                placeholder="Done">
                                        </div>
                                    </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <label>Child Protected at Birth</label>
                    <div class="form-group">
                        <label>TT Status:</label>
                        <select name="tetanus_status" id="cpab" class="form-control form-control-sm" style="width: 100%;">
                            <option selected disabled value="">Select TT Status</option>
                            <option value="TT1">TT1</option>
                            <option value="TT2">TT2</option>
                            <option value="TT3">TT3</option>
                            <option value="TT4">TT4</option>
                            <option value="TT5">TT5</option>
                            <option value="FIM">Fully Immunized Mother (FIM)</option>
                        </select>
                    </div>
                </div>

                <div id="ttdateDiv" class="col-md-12"> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label>Date:</label>
                                <input name="date_ttstatus" class="form-control form-control-sm" type="date" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label>Date Assess:</label>
                                <input name="date_assess" class="form-control form-control-sm" type="date" placeholder="Date Assess">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="col-md-12">
                <label>Date Immunization Received</label>
                    <div class="form-group">
                        <select name="immunization" id="immunization" class="form-control form-control-sm" style="width: 100%;">
                            <option selected disabled value="">Select Immunization</option>
                            <option value="bcg">BCG</option>
                            <option value="hepab">HEPA B1 (within 24 hours)</option>
                            <option value="penta">Pentavalent</option>
                            <option value="opv">OPV</option>
                            <option value="ipv">IPV</option>
                            <option value="mcv">MCV</option>
                        </select>
                    </div>
                </div>

                                <div id="bcgDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>BCG:</label>
                                            <input name="bcg" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="hepaDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>HEPA B1 (within 24 hours):</label>
                                            <input name="hepab1" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>

                                <div id="pentaDiv" class="col-md-12">
                                    <div class="row"> 
                                    <div class="col-md-4">
                                        <label>Pentavalent<br></label>
                                        <div class="form-group">
                                            <label>1:</label>
                                            <input name="pentavalent1st" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><br></label>
                                        <div class="form-group">
                                            <label>2:</label>
                                            <input name="pentavalent2nd" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><br></label>
                                        <div class="form-group">
                                            <label>3:</label>
                                            <input name="pentavalent3rd" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="opvDiv" class="col-md-12">
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <label>OPV<br></label>
                                        <div class="form-group">
                                            <label>1:</label>
                                            <input name="opv1st" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><br></label>
                                        <div class="form-group">
                                            <label>2:</label>
                                            <input name="opv2nd" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><br></label>
                                        <div class="form-group">
                                            <label>3:</label>
                                            <input name="opv3rd" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div id="ipvDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>IPV:</label>
                                            <input name="ipv" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>


                            <div id="mcvDiv" class="col-md-12">
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>MCV1 (AMV):</label>
                                            <input name="mcv1" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>MCV2 (MMR):</label>
                                            <input name="mcv2" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Date Fully Immunized Child (FIC)</label>
                                            <input name="ficdate" class="form-control form-control-sm" type="date"
                                                placeholder="Date">
                                        </div>
                                    </div>


            <div class="col-md-12">
                <label>Child was Breastfed</label>
                    <div class="form-group">
                        <select name="breastfed" id="breastfed" class="form-control form-control-sm" style="width: 100%;">
                            <option selected disabled value="">Select Month</option>
                            <option value="1mo">1st Month</option>
                            <option value="2mo">2nd Month</option>
                            <option value="3mo">3rd Month</option>
                            <option value="4mo">4th Month</option>
                            <option value="5mo">5th Month</option>
                            <option value="6mo">6th Month</option>
                        </select>
                    </div>
                </div>

                                <div id="firstDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>1st Month:</label>
                                                <input name="breastfed1st" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="secondDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>2nd Month:</label>
                                                <input name="breastfed2nd" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="thirdDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>3rd Month:</label>
                                                <input name="breastfed3rd" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="fourthDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>4th Month:</label>
                                                <input name="breastfed4th" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="fifthDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>5th Month:</label>
                                                <input name="breastfed5th" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div id="sixthDiv" class="col-md-12">
                                        <div class="form-group">
                                            <label>6th Month:</label>
                                                <input name="breastfed6th" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                            <label>Complementary Feeding</label>
                                            <div class="form-group">
                                            <label>6th Month:</label>
                                                <input name="complementary" class="form-control form-control-sm" type="date"
                                                    placeholder="Date">
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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add new
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
            $nutrition1_id = $_POST['nutrition1_id'];
            $reg_date = $_POST['reg_date'];
            $birth_date = $_POST['birth_date'];
            $fname = $_POST['fname'];
            $minitial = $_POST['minitial'];
            $lname = $_POST['lname'];
            $weight = $_POST['weight'];
            $height = $_POST['height'];
            $sex = $_POST['sex'];
            if (isset($_POST['selected_mother_name']) && $_POST['selected_mother_name'] !== 'others') {
                $mother_name = $_POST['selected_mother_name'];
            } elseif (isset($_POST['new_mother_name'])) {
                $mother_name = $_POST['new_mother_name'];
            } else {
                die("Error: No mother name provided");
            }
            $purok = $_POST['purok'];
            $address = $_POST['address'];
            $screening_done = $_POST['screening_done'];
            $tetanus_status = $_POST['tetanus_status'];
            $date_ttstatus = $_POST['date_ttstatus'];
            $date_assess = $_POST['date_assess'];
            $bcg = $_POST['bcg'];
            $hepab1 = $_POST['hepab1'];
            $pentavalent1st = $_POST['pentavalent1st'];
            $pentavalent2nd = $_POST['pentavalent2nd'];
            $pentavalent3rd = $_POST['pentavalent3rd'];
            $opv1st = $_POST['opv1st'];
            $opv2nd = $_POST['opv2nd'];
            $opv3rd = $_POST['opv3rd'];
            $ipv = $_POST['ipv'];
            $mcv1 = $_POST['mcv1'];
            $mcv2 = $_POST['mcv2'];
            $ficdate = $_POST['ficdate'];
            $breastfed1st = $_POST['breastfed1st'];
            $breastfed2nd = $_POST['breastfed2nd'];
            $breastfed3rd = $_POST['breastfed3rd'];
            $breastfed4th = $_POST['breastfed4th'];
            $breastfed5th = $_POST['breastfed5th'];
            $breastfed6th = $_POST['breastfed6th'];
            $complementary = $_POST['complementary'];
            $remarks = $_POST['remarks'];
            $remarks = mysqli_real_escape_string($con, $remarks);

            $nutrition1add = mysqli_query($con, "INSERT INTO nutrition1 VALUES ('$nutrition1_id', '$reg_date', '$birth_date', '$fname', '$minitial', 
        '$lname', '$weight', '$height', '$sex', '$mother_name', '$purok', '$address', '$screening_done', '$tetanus_status', 
    '$date_ttstatus', '$date_assess', '$bcg', '$hepab1', '$pentavalent1st', '$pentavalent2nd', '$pentavalent3rd', '$opv1st',
    '$opv2nd', '$opv3rd', '$ipv', '$mcv1', '$mcv2', '$ficdate', '$breastfed1st', '$breastfed2nd', 
    '$breastfed3rd', '$breastfed4th', '$breastfed5th', '$breastfed6th', '$complementary', '$remarks')");


            if ($nutrition1add) { ?>
                                <script type="text/javascript">
                                    alert("A new client has been added.");
                                    window.location = "../nutrition1/nutrition1.php";
                                </script>
                    <?php }

        }
        ?>

    
    <?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
} ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('mother_name').addEventListener('change', function () {
            if (this.value === 'others') {
                document.getElementById('new_name_input').style.display = 'block';
                document.getElementById('new_name_input').setAttribute('required', 'required');
            } else {
                document.getElementById('new_name_input').style.display = 'none';
                document.getElementById('new_name_input').removeAttribute('required');
            }
        });
    });

        const cpabSelect = document.getElementById('cpab');
        const ttdateDiv = document.getElementById('ttdateDiv');

        const immunizationSelect = document.getElementById('immunization');
        const bcgDiv = document.getElementById('bcgDiv');
        const hepaDiv = document.getElementById('hepaDiv');
        const pentaDiv = document.getElementById('pentaDiv');
        const opvDiv = document.getElementById('opvDiv');
        const ipvDiv = document.getElementById('ipvDiv');
        const mcvDiv = document.getElementById('mcvDiv');

        const breastfedSelect = document.getElementById('breastfed');
        const firstDiv = document.getElementById('firstDiv');
        const secondDiv = document.getElementById('secondDiv');
        const thirdDiv = document.getElementById('thirdDiv');
        const fourthDiv = document.getElementById('fourthDiv');
        const fifthDiv = document.getElementById('fifthDiv');
        const sixthDiv = document.getElementById('sixthDiv');


        cpabSelect.addEventListener('change', function() {
          if (cpabSelect.value === 'TT1' || cpabSelect.value === 'TT2' || cpabSelect.value === 'TT3' || 
          cpabSelect.value === 'TT4' || cpabSelect.value === 'TT5' || cpabSelect.value === 'FIM') {
            ttdateDiv.style.display = 'block';
          } 
          else {
            ttdateDiv.style.display = 'none';
          }
        });

        immunizationSelect.addEventListener('change', function() {
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

          if (immunizationSelect.value === 'ipv') {
            ipvDiv.style.display = 'block';
          } else {
            ipvDiv.style.display = 'none';
          }

          if (immunizationSelect.value === 'mcv') {
            mcvDiv.style.display = 'block';
          } else {
            mcvDiv.style.display = 'none';
          }
        });
        
        breastfedSelect.addEventListener('change', function() {
          if (breastfedSelect.value === '1mo') {
            firstDiv.style.display = 'block';
          } else {
            firstDiv.style.display = 'none';
          }

          if (breastfedSelect.value === '2mo') {
            secondDiv.style.display = 'block';
          } else {
            secondDiv.style.display = 'none';
          }

          if (breastfedSelect.value === '3mo') {
            thirdDiv.style.display = 'block';
          } else {
            thirdDiv.style.display = 'none';
          }

          if (breastfedSelect.value === '4mo') {
            fourthDiv.style.display = 'block';
          } else {
            fourthDiv.style.display = 'none';
          }

          if (breastfedSelect.value === '5mo') {
            fifthDiv.style.display = 'block';
          } else {
            fifthDiv.style.display = 'none';
          }

          if (breastfedSelect.value === '6mo') {
            sixthDiv.style.display = 'block';
          } else {
            sixthDiv.style.display = 'none';
          }
        });
      </script>

<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<script src="../../plugins/toastr/toastr.min.js"></script>