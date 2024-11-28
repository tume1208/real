<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'C:\xampp\secure\connect.php';

header('Content-Type: application/json');

// Correct the SQL query to match the actual columns in your products table
$sql = "SELECT id, name, img, description, price FROM products";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Failed to execute query: " . $conn->error]);
    exit();
}

$products = array();
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

$conn->close();
?>



