<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'C:\xampp\secure\connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    error_log("Raw input: " . $input); // Log the raw input

    $data = json_decode($input, true);
    error_log("Decoded data: " . print_r($data, true)); // Log the decoded data

    if (isset($data['userId']) && isset($data['data'])) {
        $userId = $data['userId'];
        $cartData = json_encode($data['data']);

        // Debugging: Log the received data
        error_log("Received userId: " . $userId);
        error_log("Received cartData: " . $cartData);

        $stmt = $conn->prepare("REPLACE INTO user_cart (user_id, cart_data) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $cartData);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
            error_log("Data stored successfully for user ID: $userId");
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
            error_log("Error storing data: " . $conn->error);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        error_log("Invalid input data: " . print_r($data, true));
    }
}
?>


