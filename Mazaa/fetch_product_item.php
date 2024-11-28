<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'C:\xampp\secure\connect.php';

header('Content-Type: application/json');

$product_id = $_GET['id'];
$sql = "SELECT id, name, img, `desc`, images, price FROM product_item WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
    exit();
}
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $product['images'] = json_decode($product['images']);
    echo json_encode($product);
} else {
    echo json_encode(["error" => "Product not found"]);
}

$stmt->close();
$conn->close();
?>






