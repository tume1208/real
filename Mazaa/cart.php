<form method="post" class="box" action="cart.php">
    <input type="number" min="1" name="product_quantity" value="1">
    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
<?php
include 'C:\xampp\secure\connect.php';

session_start(); // Start the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Retrieve the user ID from the session
} else {
    // Handle the case where the user ID is not set in the session
    die('User not logged in');
}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart_items` WHERE product_id = '$product_id' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart_items`(user_id, product_id, product_name, quantity) VALUES('$user_id', '$product_id', '$product_name', '$product_quantity')") or die('query failed');
      $message[] = 'Product added to cart!';
   }

}

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart_items` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'Cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart_items` WHERE id = '$remove_id'") or die('query failed');
   header('location:cart.html');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart_items` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.html');
}
?>
