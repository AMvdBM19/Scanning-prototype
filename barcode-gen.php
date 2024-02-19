<?php
require 'barcode/vendor/autoload.php';

// This will output the barcode as HTML output to display in the browser
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode('thisistest', $generator::TYPE_CODE_128);