<?php
// Initialize $randomItems as an empty array
$randomItems = [];

// Check if the form in randompick.php has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numberOfItems"])) {
    // Get the number of items from the form
    $numberOfItems = $_POST["numberOfItems"];

    // Include the function definition file
    require_once 'qr-gen.php'; // Replace 'qr-gen.php' with the actual filename

    // Specify the path to your CSV file
    $csvFilePath = 'database.csv'; // Replace 'database.csv' with the path to your CSV file

    // Generate a random page
    $randomItems = generateRandomPage($csvFilePath, $numberOfItems);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Order</title>
</head>
<body>

<h2>Generated Table</h2>

<form id="orderForm" action="generate_receipt.php" method="post">
    <table border="1">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Location</th>
                <th>Checkbox</th> <!-- New column for checkboxes -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Display table rows if $randomItems is not empty
            if (!empty($randomItems)) {
                foreach ($randomItems as $row) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "<td><input type='checkbox' name='selectedItems[]' value='" . htmlspecialchars(implode(',', $row)) . "'></td>"; // Checkbox column
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Add a single text input at the end of the table -->
    <label for="additionalInfo">Barcode Scan: </label>
    <input type="text" id="additionalInfo" name="additionalInfo">
    <button type="button" onclick="checkBarcode()">Check Barcode</button>
    
    <!-- Add a button to confirm the order -->
    <button type="submit">Confirm Order and Generate Receipt</button>
</form>

<script>
function checkBarcode() {
    // Get the barcode from the additional information input field
    var barcode = document.getElementById("additionalInfo").value;

    // Iterate over table rows to find the corresponding SKU or location barcode
    var rows = document.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) { // Start from 1 to skip table header row
        var cells = rows[i].getElementsByTagName("td");
        var skuCell = cells[0]; // SKU column
        var locationCell = cells[2]; // Location column
        if (skuCell.textContent.trim() === barcode.trim() || locationCell.textContent.trim() === barcode.trim()) {
            // Found the SKU or location barcode, check the checkbox for this row
            var checkbox = rows[i].querySelector("input[type='checkbox']");
            if (checkbox) {
                checkbox.checked = true;
            }
            break;
        }
    }

    // Clear the value of the additional information input field
    document.getElementById("additionalInfo").value = "";
}

// Listen for keydown event on the additional information input field
document.getElementById("additionalInfo").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        // Prevent the default action of the Enter key (form submission)
        event.preventDefault();
        // Call the checkBarcode function when Enter key is pressed
        checkBarcode();
    }
});
</script>


</body>
</html>
