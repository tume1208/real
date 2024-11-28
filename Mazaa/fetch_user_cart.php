<?php
include 'C:\xampp\secure\connect.php';

$userId = $_GET['userId'];

$stmt = $conn->prepare("SELECT cart_data FROM user_cart WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $cart_row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => json_decode($cart_row['cart_data'])]);
} else {
    echo json_encode(['success' => false, 'data' => []]);
}
?>
