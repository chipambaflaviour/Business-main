<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the statement to avoid SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        // Password is correct, start the session
        $_SESSION['admin'] = $admin['username'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        // Invalid credentials
        $_SESSION['error'] = 'Invalid username or password.';
        header("Location: home.php");  // Redirect back to the login page
        exit;
    }
}
?>
