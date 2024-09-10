<?php
include 'db.php'; // Make sure to include the database connection file

session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Query to fetch comments
$query = "
    SELECT comments.id, products.name AS product_name, comments.comment, comments.created_at
    FROM comments
    JOIN products ON comments.product_id = products.id
    ORDER BY comments.created_at DESC
";

// Execute the query
$result = $mysqli->query($query);

if (!$result) {
    die("Query failed: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Comments</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .delete-btn {
            background-color: #d32f2f;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c62828;
        }
        .btn-dashboard {
            background-color: #4CB5F5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-dashboard:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_dashboard.php" class="btn-dashboard">Return to Admin Dashboard</a>
        <h1 class="my-4">Comments</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Comment</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <form action="delete_comment.php" method="post" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            <input type="hidden" name="comment_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
