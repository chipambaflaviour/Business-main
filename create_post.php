<?php
// Include database connection
require 'db.php';
session_start(); // Ensure session is started

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $title = $mysqli->real_escape_string($_POST['title']);
    $content = $mysqli->real_escape_string($_POST['content']);
    $admin_id = $_SESSION['admin_id']; // Assume admin_id is stored in session

    // Handle image upload
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'images/' . $imageName; // Save images to 'images' folder
        move_uploaded_file($imageTmpName, $imagePath);
    }

    // Insert post into database
    $sql = "INSERT INTO posts (admin_id, title, content, image) VALUES ('$admin_id', '$title', '$content', '$imagePath')";

    if ($mysqli->query($sql) === TRUE) {
        $message = "New post created successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
    header("Location: admin_dashboard.php"); // Redirect to admin dashboard after saving
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-container input[type="file"] {
            width: 100%;
            margin-bottom: 15px;
        }
        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .back-button {
            display: block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }
        .back-button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create New Post</h2>
        <form action="create_post.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Post Title" required>
            <textarea name="content" placeholder="Post Content" rows="5" required></textarea>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Create Post</button>
        </form>
        <a href="admin_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
