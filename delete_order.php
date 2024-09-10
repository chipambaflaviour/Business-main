<?php
include 'db.php'; // Include the database connection file

session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Check if the order ID is set
if (isset($_POST['order_id'])) {
    $order_id = $mysqli->real_escape_string($_POST['order_id']);

    // Query to delete the order
    $query = "DELETE FROM orders WHERE id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $order_id);
        if ($stmt->execute()) {
            // Redirect back to the view orders page with success message
            header("Location: view_orders.php?message=Order deleted successfully");
            exit();
        } else {
            die("Execution failed: " . $stmt->error);
        }
    } else {
        die("Preparation failed: " . $mysqli->error);
    }
} else {
    die("Invalid request");
}
?>
