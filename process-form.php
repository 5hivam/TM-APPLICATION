<?php
require_once 'vendor/autoload.php'; // Include the necessary libraries

use PhpOffice\PhpWord\TemplateProcessor;

// Retrieve form data
$sellerName = $_POST['sellerName'];
$sellerFatherName = $_POST['sellerFatherName'];
$sellerAddress = $_POST['sellerAddress'];
$propertyAddress = $_POST['propertyAddress'];
$landArea = $_POST['propertyLandArea'];
$buyerName = $_POST['buyerName'];
$buyerFatherName = $_POST['buyerFatherName'];
$buyerAddress = $_POST['buyerAddress'];

// Load the template document
$templateFile = 'template.docx';
$templateProcessor = new TemplateProcessor($templateFile);

// Replace the placeholders in the template with actual values
$templateProcessor->setValue('SELLER_NAME', $sellerName);
$templateProcessor->setValue('SELLER_FATHER_NAME', $sellerFatherName);
$templateProcessor->setValue('SELLER_ADDRESS', $sellerAddress);
$templateProcessor->setValue('PROPERTY_ADDRESS', $propertyAddress);
$templateProcessor->setValue('LAND_AREA', $landArea);
$templateProcessor->setValue('BUYER_NAME', $buyerName);
$templateProcessor->setValue('BUYER_FATHER_NAME', $buyerFatherName);
$templateProcessor->setValue('BUYER_ADDRESS', $buyerAddress);

// Generate a unique filename for the downloaded document
$filename = 'transfer_memorandum_' . uniqid() . '.docx';

// Save the modified document as a new file
$templateProcessor->saveAs($filename);

// Set the appropriate headers for the file download
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Output the file content to the browser
readfile($filename);

// Delete the temporary file
unlink($filename);
