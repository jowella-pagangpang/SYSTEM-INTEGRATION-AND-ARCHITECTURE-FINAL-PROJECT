<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Fields</title>
</head>
<body>
    <form id="ironForm" method="post" action="your_server_script.php">
        <div class="col-sm-6">
            <label>Iron with Folic Acid</label>
        </div>
        <div id="formFields">
            <!-- Initial input fields for 1st date and number -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Date:</label>
                    <input name="iron1stdate" class="form-control form-control-sm" type="date" placeholder="Date">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Number:</label>
                    <input name="1stdatenumber" class="form-control form-control-sm" type="number" placeholder="No.">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <button type="button" id="addButton">Add</button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const formFields = document.getElementById("formFields");
            const addButton = document.getElementById("addButton");
            let fieldNumber = 2; // Start with the 2nd date and number fields

            addButton.addEventListener("click", function () {
                if (fieldNumber <= 6) {
                    const dateFieldName = `iron${fieldNumber}thdate`;
                    const numberFieldName = `${fieldNumber}thdatenumber`;

                    // Create a new set of date and number input fields
                    const newFields = document.createElement("div");
                    newFields.innerHTML = `
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date:</label>
                                <input name="${dateFieldName}" class="form-control form-control-sm" type="date" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Number:</label>
                                <input name="${numberFieldName}" class="form-control form-control-sm" type="number" placeholder="No.">
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
    </script>
</body>
</html>


