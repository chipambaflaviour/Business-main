<?php
include 'db.php'; // This will include the connection code and set up $mysqli
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Define the query with the correct columns
$query = "SELECT id, name, email, subject, message, submission_date FROM contact_form_submissions ORDER BY submission_date DESC";

// Execute the query using $mysqli
$result = $mysqli->query($query);

if (!$result) {
    die("Error executing query: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submissions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            text-align: center;
            border-radius: 3px;
        }
        .action-btn:hover {
            background-color: #d32d2d;
        }
        .dashboard-btn {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
        }
        .dashboard-btn:hover {
            background-color: #1e88e5;
        }
    </style>
</head>
<body>
    <h1>Contacts</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Submission Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display data from the result set
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                echo "<td>" . htmlspecialchars($row['submission_date']) . "</td>";
                echo "<td><a href='delete_contact.php?id=" . htmlspecialchars($row['id']) . "' class='action-btn'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table><br>
    <a href="admin_dashboard.php" class="dashboard-btn">Back to Dashboard</a>
</body>
</html>
