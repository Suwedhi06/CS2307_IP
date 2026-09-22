<?php
include "db_connect.php";

$customer_name = $_POST['customer_name'];
$product_name  = $_POST['product_name'];
$quantity      = $_POST['quantity'];
$price         = $_POST['price'];

$sql = "INSERT INTO orders (customer_name, product_name, quantity, price) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssid", $customer_name, $product_name, $quantity, $price);

if ($stmt->execute()) {
    echo "<h3>Order placed successfully!</h3>";
    echo "<a href='view_orders.php'>View all orders</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
