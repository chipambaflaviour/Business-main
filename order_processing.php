<?php
// order_processing.php

// Include the database connection file
include 'db.php';

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$product_id = $_POST['product'];
$quantity = $_POST['quantity'];

// Prepare an SQL statement to prevent SQL injection
$stmt = $mysqli->prepare("INSERT INTO orders (customer_name, email, product_id, quantity) VALUES (?, ?, ?, ?)");

// Bind the parameters to the SQL query
$stmt->bind_param("ssii", $name, $email, $product_id, $quantity);

// Execute the statement
if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the MySQLi connection
$stmt->close();
$mysqli->close();
?>
