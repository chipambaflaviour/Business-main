<?php
include 'db.php'; // This will include the connection code and set up $mysqli
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Check if 'id' is set in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM contact_form_submissions WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view_contacts.php?message=Contact deleted successfully");
    } else {
        die("Error deleting contact: " . $stmt->error);
    }
    
    $stmt->close();
} else {
    die("Invalid request");
}

$mysqli->close();
?>
