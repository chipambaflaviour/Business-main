<?php
// process_contact_form.php

// Include the database connection file
include 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $mysqli->prepare("INSERT INTO contact_form_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)");

    // Bind the parameters to the SQL query
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the MySQLi connection
$mysqli->close();
?>
