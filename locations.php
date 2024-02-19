<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>QR Code Generator</h1>

    <form action="" method="post">
        <label for="warehouse">Warehouse:</label>
        <input type="number" name="warehouse" required><br>

        <label for="bay">Bay:</label>
        <input type="text" name="bay" required><br>

        <label for="row">Row:</label>
        <input type="number" name="row" required><br>

        <label for="tiers">Tiers:</label>
        <input type="number" name="tiers" required><br>

        <input type="submit" name="generate" value="Generate QR Codes">
    </form>

    <?php
    include('C:\xampp\htdocs\QRtest\qr-gen.php');

    // Check if the form has been submitted
    if (isset($_POST['generate'])) {
        $warehouse = $_POST['warehouse'];
        $bay = $_POST['bay'];
        $row = $_POST['row'];
        $tiers = $_POST['tiers'];

        generateLocationQR($warehouse, $bay, $row, $tiers);
    }
    ?>
</body>
</html>
