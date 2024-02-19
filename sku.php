<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Generator for Items</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>QR Code Generator for Items</h1>

    <form action="" method="post">
        <label name="sku-placeholder">SKU:
            <input type="text" name="sku" required><br>
            <input type="submit" name="generate" value="Generate SKU Barcode">
        </label>
    </form>

    <?php
    include('C:\xampp\htdocs\QRtest\qr-gen.php');

    // Check if the form has been submitted
    if (isset($_POST['generate'])) {

        $sku = $_POST['sku'];

        generateSKUQR($sku);
    }
    ?>
</body>
</html>