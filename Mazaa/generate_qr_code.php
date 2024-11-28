<?php
include 'C:\xampp\secure\connect.php';
require 'vendor/autoload.php'; // Include the QR code library

use Endroid\QrCode\QrCode;

$userId = $_GET['userId'];
$amount = $_GET['amount'];
$transactionId = uniqid();

// Generate the QR code URL
$qrCodeUrl = "http://localhost/MAZAA/upload_receipt.php?transactionId=$transactionId&userId=$userId&amount=$amount";

// Create the QR code
$qrCode = new QrCode($qrCodeUrl);
$qrCode->writeFile('images/qr_code.png'); // Save the QR code image

echo '<img src="images/qr_code.png" alt="QR Code">';
?>
