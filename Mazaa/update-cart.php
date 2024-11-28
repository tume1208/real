<?php
include 'C:\xampp\secure\connect.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['addToCart'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the product is already in the cart
    $checkCart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $checkCart->bind_param("ii", $userId, $productId);
    $checkCart->execute();
    $result = $checkCart->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the product is already in the cart
        $updateCart = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $updateCart->bind_param("iii", $quantity, $userId, $productId);
        $updateCart->execute();
    } else {
        // Insert a new row if the product is not in the cart
        $insertCart = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insertCart->bind_param("iii", $userId, $productId, $quantity);
        $insertCart->execute();
    }
}
?>

