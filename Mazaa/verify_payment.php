<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'C:\xampp\secure\connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown error'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $transactionId = $_POST['transactionId'];
        $userId = $_POST['userId'];
        $amount = $_POST['amount'];
        $receipt = $_FILES['receipt'];

        // Debugging: Print received data
        error_log("Received data: transactionId=$transactionId, userId=$userId, amount=$amount, receipt=" . print_r($receipt, true));

        // Check if the file was uploaded without errors
        if ($receipt['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            
            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadFile = $uploadDir . basename($receipt['name']);

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($receipt['tmp_name'], $uploadFile)) {
                // Insert the payment information into the database
                $stmt = $conn->prepare("INSERT INTO payments (transaction_id, user_id, amount, currency, description, receipt_path, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $currency = 'MNT';
                $description = 'Payment for order';
                $status = 'pending';
                $stmt->bind_param("sssssss", $transactionId, $userId, $amount, $currency, $description, $uploadFile, $status);

                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Payment recorded successfully';
                } else {
                    error_log("Database insert error: " . $stmt->error);
                    $response['message'] = 'Failed to insert payment information';
                }

                $stmt->close();
                $conn->close();
            } else {
                error_log("Failed to move uploaded file");
                $response['message'] = 'Failed to move uploaded file';
            }
        } else {
            error_log("File upload error: " . $receipt['error']);
            $response['message'] = 'File upload error';
        }
    } else {
        error_log("Invalid request method");
        $response['message'] = 'Invalid request method';
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    $response['message'] = 'Server error';
}

echo json_encode($response);
?>
