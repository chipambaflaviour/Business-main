<?php
include 'db.php'; // Include the database connection
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

$admin_username = $_SESSION['admin'];

// Fetch counts from the database
$product_count_query = "SELECT COUNT(*) AS total_products FROM products";
$product_count_result = $mysqli->query($product_count_query);
$product_count = $product_count_result->fetch_assoc()['total_products'];

$comment_count_query = "SELECT COUNT(*) AS total_comments FROM comments";
$comment_count_result = $mysqli->query($comment_count_query);
$comment_count = $comment_count_result->fetch_assoc()['total_comments'];

$order_count_query = "SELECT COUNT(*) AS total_orders FROM orders";
$order_count_result = $mysqli->query($order_count_query);
$order_count = $order_count_result->fetch_assoc()['total_orders'];

$contact_count_query = "SELECT COUNT(*) AS total_contacts FROM contact_form_submissions";
$contact_count_result = $mysqli->query($contact_count_query);
$contact_count = $contact_count_result->fetch_assoc()['total_contacts'];

// Close the database connection
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-image: url('b4.jfif'); /* Update the URL */
            background-size: cover;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .sidebar {
            background-image: url('b4.jfif'); /* Update the URL */
            background-size: cover;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background on hover */
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: whitesmoke;
            min-height: 100vh;
        }
        .content h1 {
            text-align: center;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .footer-links {
            margin-bottom: 10px;
        }
        .footer-links a {
            color: #fff;
            margin: 0 10px;
            font-size: 24px;
            text-decoration: none;
        }
        button {
            background-color: #D32D41;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            text-align: center;
        }
        button:hover {
            opacity: 0.8;
        }
        .card {
            border-radius: 8px;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .card1 { background-color: #4CB5F5; }
        .card2 { background-color: #6AB187; }
        .card3 { background-color: #D32D41; }
        .card4 { background-color: #B3C100; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="#">ALTECH BUSINESS CENTER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin_dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Admin Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_products.php">
                                <i class="fas fa-eye"></i>
                                View Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_comments.php">
                                <i class="fas fa-comments"></i>
                                View Comments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">
                                <i class="fas fa-plus-circle"></i>
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_post.php">
                                <i class="fas fa-edit"></i>
                                Create Post
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_orders.php">
                                <i class="fas fa-shopping-cart"></i>
                                View Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_contacts.php">
                                <i class="fas fa-envelope"></i>
                                View Contacts
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <button><a class="nav-link text-white" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a></button>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome Admin: <?php echo htmlspecialchars($admin_username); ?></h1>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card1">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text display-4"><?php echo $product_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card2">
                            <div class="card-body">
                                <h5 class="card-title">Total Comments</h5>
                                <p class="card-text display-4"><?php echo $comment_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card3">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <p class="card-text display-4"><?php echo $order_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card4">
                            <div class="card-body">
                                <h5 class="card-title">Total Contacts</h5>
                                <p class="card-text display-4"><?php echo $contact_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 ALTECH BUSINESS CENTER. All rights reserved.</p>
        <p>&copy; Powered by Brian, brianlupasa14@gmail.com</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
