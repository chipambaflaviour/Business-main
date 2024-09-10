<?php
include 'db.php'; // Include the database connection file

session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Check if the comment ID is set
if (isset($_POST['comment_id'])) {
    $comment_id = $mysqli->real_escape_string($_POST['comment_id']);

    // Query to delete the comment
    $query = "DELETE FROM comments WHERE id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $comment_id);
        if ($stmt->execute()) {
            // Redirect back to the view comments page with success message
            header("Location: view_comments.php?message=Comment deleted successfully");
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
