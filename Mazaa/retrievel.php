<?php

include 'connect.php';
session_start();

$userId = $_SESSION['user_id'];

$getCart = $conn->prepare("SELECT products.name, products.price, cart.quantity 
                           FROM cart 
                           JOIN products ON cart.product_id = products.id 
                           WHERE cart.user_id = ?");
$getCart->bind_param("i", $userId);
$getCart->execute();
$result = $getCart->get_result();

while($row = $result->fetch_assoc()){
    echo "Product: " . $row['name'] . " - Price: " . $row['price'] . " - Quantity: " . $row['quantity'] . "<br>";
}
?>
