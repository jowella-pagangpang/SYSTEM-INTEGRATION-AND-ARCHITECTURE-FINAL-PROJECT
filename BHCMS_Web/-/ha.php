<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Iron Data</title>
</head>
<body>
    <form id="ironForm" method="post" action="update_database_script.php">
        <div class="col-sm-6">
            <label>Iron with Folic Acid</label>
        </div>
        <div id="formFields">
            <?php
            // Assuming you have fetched the database values into an array $row
            for ($i = 1; $i <= 6; $i++) {
                $ironDate = $row["iron{$i}date"];
                $dateNumber = max(0, $row["{$i}datenumber"]);
                if (!empty($ironDate) || !empty($dateNumber)) {
            ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date:</label>
                            <input name="iron<?php echo $i; ?>date" class="form-control form-control-sm" type="date" value="<?php echo $ironDate; ?>">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Number:</label>
                            <input name="<?php echo $i; ?>datenumber" class="form-control form-control-sm" type="number" min="0" value="<?php echo $dateNumber; ?>">
                        </div>
                    </div>
            <?php 
                }
            }
            ?>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="button" id="addButton">Add</button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addButton = document.getElementById("addButton");
            let fieldNumber = <?php echo $i; ?>; // Start with the next available field number

            addButton.addEventListener("click", function () {
                if (fieldNumber <= 6) {
                    // Create new date and number fields
                    const newDateField = document.createElement("div");
                    newDateField.innerHTML = `
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date:</label>
                                <input name="iron${fieldNumber}date" class="form-control form-control-sm" type="date" placeholder="Date">
                            </div>
                        </div>
                    `;
                    const newNumberField = document.createElement("div");
                    newNumberField.innerHTML = `
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Number:</label>
                                <input name="${fieldNumber}datenumber" class="form-control form-control-sm" type="number" min="0" placeholder="No.">
                            </div>
                        </div>
                    `;

                    // Append new fields to the form
                    document.getElementById("formFields").appendChild(newDateField);
                    document.getElementById("formFields").appendChild(newNumberField);

                    fieldNumber++;

                    // Hide the "Add" button after the 6th date field is added
                    if (fieldNumber > 6) {
                        addButton.style.display = "none";
                    }
                }
            });
        });
    </script>
</body>
</html>
