<?php
include 'db.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Set the number of products per page
$products_per_page = 7;

// Get the current page from the query string or default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $products_per_page;

// Fetch products from the database with optional search filtering
$search = isset($_GET['search']) ? mysqli_real_escape_string($mysqli, $_GET['search']) : '';
$query = "SELECT * FROM products WHERE name LIKE '%$search%' LIMIT $start, $products_per_page";
$result = mysqli_query($mysqli, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($mysqli));
}

// Get total number of products for pagination
$total_query = "SELECT COUNT(*) as total FROM products WHERE name LIKE '%$search%'";
$total_result = mysqli_query($mysqli, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $products_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Altech Business Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
        }
        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .search-container input[type="text"] {
            width: 80%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search-container input[type="submit"] {
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .product-grid {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 200px; /* Fixed width for cards */
            padding: 15px;
            text-align: center;
            background-color: #fff;
            box-sizing: border-box;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .product-card h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .product-card p {
            font-size: 0.9em;
            color: #555;
        }
        .product-card .btn {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            font-size: 0.9em;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .product-card .btn-danger {
            background-color: #DC3545;
        }
        .product-card .btn-warning {
            background-color: #FFC107;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            display: inline-block;
            padding: 10px 15px;
            font-size: 1em;
            color: #007BFF;
            text-decoration: none;
            border: 1px solid #007BFF;
            border-radius: 5px;
            margin: 0 5px;
        }
        .pagination a.active {
            background-color: #007BFF;
            color: #fff;
        }
        .pagination a:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .back-button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Altech Business Center</h1>
        <div class="search-container">
            <form method="GET" action="view_products.php">
                <input type="text" name="search" placeholder="Search for a product name..." value="<?php echo htmlspecialchars($search); ?>">
                <input type="submit" value="Search">
            </form>
        </div>
        <a href="admin_dashboard.php" class="back-button">Back to Dashboard</a>
        <div class="product-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p>Price: ZMW <?php echo htmlspecialchars(number_format($row['price'], 2)); ?></p>
                    <a href="update_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="view_products.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="view_products.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="view_products.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
