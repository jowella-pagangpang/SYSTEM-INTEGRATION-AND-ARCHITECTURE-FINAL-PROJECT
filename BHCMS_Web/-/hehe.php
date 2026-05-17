<!DOCTYPE html>
<html>
<head>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <form id="ironForm" action="insert_data.php" method="POST">
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
        <button type="button" id="addButton2">Add</button>

        <!-- Fields for iron2nddate and 2nddatenumber -->

        <!-- Additional fields for iron3rddate and 3rddatenumber will be added dynamically -->

        <!-- Your existing fields for iron4thdate and 4thdatenumber go here -->

        <!-- Additional fields for iron5thdate and 5thdatenumber will be added dynamically -->

        <!-- Your existing fields for iron6thdate and 6thdatenumber go here -->

        <button type="submit">Submit</button>
    </form>

    <script>
        // JavaScript code to add fields dynamically
        let counter = 2; // Start from the 3rd set of fields

        document.getElementById("addButton2").addEventListener("click", function() {
            if (counter <= 6) {
                const form = document.getElementById("ironForm");

                const dateField = document.createElement("div");
                dateField.classList.add("col-sm-6");
                dateField.innerHTML = `
                    <div class="form-group">
                        <label>Date:</label>
                        <input name="iron${counter}thdate" class="form-control form-control-sm" type="date" placeholder="Date">
                    </div>
                `;

                const numberField = document.createElement("div");
                numberField.classList.add("col-sm-5");
                numberField.innerHTML = `
                    <div class="form-group">
                        <label>Number:</label>
                        <input name="${counter}thdatenumber" class="form-control form-control-sm" type="number" placeholder="No.">
                    </div>
                `;

                form.insertBefore(dateField, this);
                form.insertBefore(numberField, this);

                counter++;
            }

            // Hide the button when we reach the maximum (6th set)
            if (counter > 6) {
                this.style.display = "none";
            }
        });
    </script>
</body>
</html>
