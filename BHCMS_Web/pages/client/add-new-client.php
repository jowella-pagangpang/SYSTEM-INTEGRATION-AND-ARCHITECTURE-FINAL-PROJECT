<?php include('../dbcon.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<?php if ($_SESSION['type'] == "Barangay Health Worker"): ?>

<head>
<style>
#readonly-field { background-color: transparent; border: none; }
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

#bims-search-box {
    position: relative;
    margin-bottom: 15px;
}
#bims-search-input {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid #4a235a;
    border-radius: 5px;
    font-size: 14px;
}
#bims-results {
    position: absolute;
    z-index: 9999;
    background: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: none;
}
.bims-result-item {
    padding: 8px 12px;
    cursor: pointer;
    font-size: 13px;
    border-bottom: 1px solid #f0f0f0;
}
.bims-result-item:hover { background-color: #f3e5f5; }
.bims-badge {
    background: #4a235a;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 5px;
}
</style>

<script>
function validateInput(inputElement) {
    let inputValue = inputElement.value;
    let lettersOnly = inputValue.replace(/[^a-zA-Z\s.]/g, '');
    if (inputValue !== lettersOnly) {
        inputElement.value = lettersOnly;
    }
}

// Search residents from BIMS API
let searchTimeout;
function searchBims(query) {
    clearTimeout(searchTimeout);

    if (query.length < 2) {
        document.getElementById('bims-results').style.display = 'none';
        return;
    }

    searchTimeout = setTimeout(function() {
        fetch('../../search_bims.php?q=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                const resultsDiv = document.getElementById('bims-results');

                if (!data || data.length === 0) {
                    resultsDiv.innerHTML = '<div class="bims-result-item" style="color:#999;">No residents found in BIMS.</div>';
                    resultsDiv.style.display = 'block';
                    return;
                }

                resultsDiv.innerHTML = data.map(r => `
                    <div class="bims-result-item" onclick="selectResident(${r.id}, '${r.fname}', '${r.mname}', '${r.surname}', '${r.bday}', '${r.sex}', '${r.purok}')">
                        <strong>${r.surname}, ${r.fname} ${r.mname}</strong>
                        <span class="bims-badge">BIMS</span>
                        <br>
                        <small style="color:#888;">Purok: ${r.purok} | Age: ${r.age}</small>
                    </div>
                `).join('');

                resultsDiv.style.display = 'block';
            })
            .catch(err => console.error('BIMS API error:', err));
    }, 300);
}

// Auto-fill form when resident is selected
function selectResident(id, fname, mname, lname, bday, sex, purok) {
    document.getElementById('bims_resident_id').value = id;
    // Fill name fields
    document.querySelector('input[name="fname"]').value   = fname;
    document.querySelector('input[name="minitial"]').value = mname;
    document.querySelector('input[name="lname"]').value   = lname;

    // Fill birthday - convert to yyyy-mm-dd format
    if (bday) {
        let date = new Date(bday);
        if (!isNaN(date)) {
            let formatted = date.toISOString().split('T')[0];
            document.querySelector('input[name="birth_date"]').value = formatted;
        }
    }

    // Fill sex radio button
    if (sex === 'Male' || sex === 'M')  {
        document.getElementById('radioPrimary1').checked = true;
    } else if (sex === 'Female' || sex === 'F') {
        document.getElementById('radioPrimary2').checked = true;
    }

    // Fill purok - match sa dropdown options
    let purokSelect = document.querySelector('select[name="purok"]');
    for (let i = 0; i < purokSelect.options.length; i++) {
        if (purokSelect.options[i].value.toLowerCase().includes(purok.toLowerCase()) ||
            purok.toLowerCase().includes(purokSelect.options[i].text.toLowerCase())) {
            purokSelect.selectedIndex = i;
            break;
        }
    }

    // Hide results
    document.getElementById('bims-results').style.display = 'none';
    document.getElementById('bims-search-input').value = lname + ', ' + fname;
}

// Hide results when clicking outside
document.addEventListener('click', function(e) {
    if (!document.getElementById('bims-search-box').contains(e.target)) {
        document.getElementById('bims-results').style.display = 'none';
    }
});
</script>
</head>

<div class="modal fade" id="add-client" style="font-family: Helvetica;">
    <form method="post" action="add.php">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Register Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div>
                                <input name="id" type="hidden">
                                <input name="bims_resident_id" id="bims_resident_id" type="hidden">
                            </div>

                            <!--BIMS Search Bar-->
                            <div class="col-md-12 mb-2">
                                <label>
                                    Search from BIMS: 
                                    <span class="bims-badge">BIMS Integration</span>
                                </label>
                                <div id="bims-search-box">
                                    <input 
                                        type="text" 
                                        id="bims-search-input"
                                        class="form-control form-control-sm"
                                        placeholder="Type resident name to search from BIMS..."
                                        oninput="searchBims(this.value)"
                                        autocomplete="off"
                                    >
                                    <div id="bims-results"></div>
                                </div>
                                <small style="color:#888;">
                                    Search ang resident sa BIMS para ma-auto-fill ang form.
                                </small>
                            </div>

                            <div class="col-md-12">
                                <hr style="border-top: 1px dashed #ccc; margin: 5px 0 10px;">
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Name: <code class="text-danger">*</code></label>
                                    <input name="fname" type="text" class="form-control form-control-sm"
                                        placeholder="First Name" oninput="validateInput(this)" required>
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

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date of Birth: <code class="text-danger">*</code></label>
                                    <input name="birth_date" class="form-control form-control-sm" 
                                        type="date" placeholder="Date of Birth" required 
                                        max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Sex: <code class="text-danger">*</code><br></label>
                                <div class="form-group">
                                    <div class="icheck-primary">
                                        <input type="radio" name="sex" value="M" id="radioPrimary1">
                                        <label for="radioPrimary1">
                                            <span class="text" style="font-weight: normal;">Male</span>
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
                                            <span class="text" style="font-weight: normal;">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name of Mother:</label>
                                    <input name="mother_name" class="form-control form-control-sm"
                                        type="text" placeholder="First Name, Middle Initial, Last Name"
                                        oninput="validateInput(this)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Complete Address: <code class="text-danger">*</code><br></label>
                                    <select name="purok" class="form-control form-control-sm" required>
                                        <option selected disabled value="">Select Purok</option>
                                        <option value="Purok 1">1</option>
                                        <option value="Purok 2">2</option>
                                        <option value="Purok 3">3</option>
                                        <option value="Purok 4">4</option>
                                        <option value="Purok 5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><br></label>
                                    <input name="address" class="form-control form-control-sm" type="text"
                                        value="Basak, San Juan, Southern Leyte" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add new client</button>
                </div>

            </div>
        </div>
    </form>
</div>

<?php elseif ($_SESSION['type'] == "Nurse"): ?>
    <?php header("Location: ../../index.php"); ?>
<?php endif; ?>