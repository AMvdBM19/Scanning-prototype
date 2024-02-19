<?php
// Check if selectedItems array is set and not empty
if (isset($_POST['selectedItems']) && is_array($_POST['selectedItems']) && !empty($_POST['selectedItems'])) {
    // Include TCPDF library
    require_once('C:\xampp\htdocs\QRtest\tcpdf\tcpdf.php');

    // Create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Receipt');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('dejavusans', '', 12);
    // Set the font size
    $pdf->SetFont('dejavusans', '', 24);

    // Add the title as plain text
    $pdf->Write(0, 'Receipt', '', 0, 'C', true, 0, false, false, 0);

    // Reset the font size back to the default value
    $pdf->SetFont('dejavusans', '', 12);

    // Output table header
    $html = '<table border="1">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>SKU</th>';
    $html .= '<th>Name</th>';
    $html .= '<th>Location</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    // Output table rows
    foreach ($_POST['selectedItems'] as $selectedItem) {
        // Split selected item into SKU, Name, and Location (assuming they are separated by comma)
        $itemData = explode(',', $selectedItem);
        $sku = isset($itemData[0]) ? trim($itemData[0]) : '';
        $name = isset($itemData[1]) ? trim($itemData[1]) : '';
        $location = isset($itemData[2]) ? trim($itemData[2]) : '';

        // Add row to HTML table
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($sku) . '</td>';
        $html .= '<td>' . htmlspecialchars($name) . '</td>';
        $html .= '<td>' . htmlspecialchars($location) . '</td>';
        $html .= '</tr>';
    }

    // Close table body and table
    $html .= '</tbody>';
    $html .= '</table>';

    // Output HTML content to PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Set the appropriate HTTP header content type for PDF
    header('Content-Type: application/pdf');

    // Output the PDF as a file attachment
    $pdf->Output('receipt.pdf', 'D');

    // Exit to prevent further execution
    exit;
} else {
    // If selectedItems array is not set or empty, display an error message or handle as needed
    echo "Selected items array is not set or empty. Redirecting to the home page."; // Debug statement
    
    // Check if the home.html file exists before redirecting
    $homeFilePath = 'home.html';
    if (file_exists($homeFilePath)) {
        header("Location: $homeFilePath");
    } else {
        echo "Home page file does not exist. Please contact the administrator.";
        exit;
    }
}

