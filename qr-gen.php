<?php

include('C:\xampp\htdocs\QRtest\qr-php\phpqrcode\qrlib.php');

function generateLocationQR($warehouse, $bay, $row, $tier) {
    $tempDir = "qr-codes/";

    // Create folder based on warehouse, bay, and row
    $folderName = $tempDir . $warehouse . '-' . $bay . '-' . $row . '/';
    if (!file_exists($folderName)) {
        mkdir($folderName, 0777, true);
    }

    // Start the parent div
    echo '<div class="code-container">';

    for ($i = 1; $i <= $tier; $i++) {
        $location = sprintf('%d%s-%02d-%02d', $warehouse, $bay, $row, $i);

        $codeContents = $location;
        $fileName = 'location_' . str_replace('-', '_', $location) . '.png';
        $pngAbsoluteFilePath = $folderName . $fileName;
        $urlRelativeFilePath = $folderName . $fileName;

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);

            // displaying
            echo '<div class="codes">';
            echo '<p>' . $location . '</p>';
            echo '<img src="' . $urlRelativeFilePath . '" />';
            echo '</div>';
        } else {
            // displaying
            echo '<div class="codes">';
            echo '<p>' . $location . '</p>';
            echo '<img src="' . $urlRelativeFilePath . '" />';
            echo '</div>';
        }
    }

    // Close the parent div
    echo '</div>';
}


function generateSKUQR($sku) {
    $tempDir = "qr-codes/";

    // Start the parent div
    echo '<div class="code-container">';

    // Encode SKU to make it safe for file name
    $encoded_sku = urlencode($sku);

    // Code contents and file name
    $codeContents = $encoded_sku;
    $fileName = $encoded_sku . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $urlRelativeFilePath = $tempDir . $fileName;

    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
            
        // displaying
        echo '<div class="codes">';
        echo '<p>' . $sku . '</p>';
        echo '<img src="' . $urlRelativeFilePath . '" />';
        echo '</div>';
    } else {
        // displaying
        echo '<div class="codes">';
        echo '<p>' . $sku . '</p>';
        echo '<img src="' . $urlRelativeFilePath . '" />';
        echo '</div>';
    }

    // Close the parent div
    echo '</div>';
}



include 'barcode/vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function generateSKUBarcode($sku) {
    $tempDir = "bar-codes/";

    // Start the parent div
    echo '<div class="code-container">';

    $generator = new BarcodeGeneratorPNG();
    $codeContents = $generator->getBarcode($sku, $generator::TYPE_CODE_128);

    $fileName = $sku . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $urlRelativeFilePath = $tempDir . $fileName;

    // Check if the barcode image file already exists
    if (!file_exists($pngAbsoluteFilePath)) {
        // If not, create the barcode image file
        file_put_contents($pngAbsoluteFilePath, $codeContents);
    }

    // Displaying
    echo '<div class="codes">';
    echo '<p>' . $sku . '</p>';
    echo '<img src="' . $urlRelativeFilePath . '" />';
    echo '</div>';

    // Close the parent div
    echo '</div>';
}


function generateLocationBarcode($warehouse, $bay, $row, $tier) {
    $tempDir = "bar-codes/";

    // Create folder based on warehouse, bay, and row
    $folderName = $tempDir . $warehouse . '-' . $bay . '-' . $row . '/';
    if (!file_exists($folderName)) {
        mkdir($folderName, 0777, true);
    }

    // Start the parent div
    echo '<div class="code-container">';

    for ($i = 1; $i <= $tier; $i++) {
        $location = sprintf('%d%s-%02d-%02d', $warehouse, $bay, $row, $i);

        $generator = new BarcodeGeneratorPNG();
        $codeContents = $generator->getBarcode($location, $generator::TYPE_CODE_128);

        $fileName = 'location_' . str_replace('-', '_', $location) . '.png';
        $pngAbsoluteFilePath = $folderName . $fileName;
        $urlRelativeFilePath = $folderName . $fileName;

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            file_put_contents($pngAbsoluteFilePath, $codeContents);

            // displaying
            echo '<div class="codes">';
            echo '<p>' . $location . '</p>';
            echo '<img src="' . $urlRelativeFilePath . '" />';
            echo '</div>';
        } else {
            // displaying
            echo '<div class="codes">';
            echo '<p>' . $location . '</p>';
            echo '<img src="' . $urlRelativeFilePath . '" />';
            echo '</div>';
        }
    }

    // Close the parent div
    echo '</div>';
}


function generateRandomPage($csvFilePath, $numberOfItems) {
    // Check if the CSV file exists
    if (!file_exists($csvFilePath)) {
        return "CSV file not found.";
    }

    // Read the CSV file into an array
    $csvData = array_map('str_getcsv', file($csvFilePath));

    // Get the total number of rows in the CSV file
    $totalRows = count($csvData);

    // Check if the number of items requested is greater than the total rows
    if ($numberOfItems > $totalRows) {
        return "Number of items requested exceeds total rows in CSV.";
    }

    // Shuffle the array to randomize the rows
    shuffle($csvData);

    // Select the specified number of items from the shuffled array
    $selectedItems = array_slice($csvData, 0, $numberOfItems);

    // Return the randomly selected items
    return $selectedItems;
}


