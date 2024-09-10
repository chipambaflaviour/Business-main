<?php
include 'db.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Check if the product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_products.php");
    exit();
}

$product_id = (int)$_GET['id'];

// Fetch the product details from the database
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($mysqli, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: view_products.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update product details
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);
    $price = mysqli_real_escape_string($mysqli, $_POST['price']);
    $image = $_POST['current_image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_path = 'images/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $image = $image_path;
        }
    }

    $update_query = "UPDATE products SET name = '$name', description = '$description', price = '$price', image = '$image' WHERE id = $product_id";
    if (mysqli_query($mysqli, $update_query)) {
        header("Location: view_products.php");
        exit();
    } else {
        $error_message = 'Update failed: ' . mysqli_error($mysqli);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product - Altech Business Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 1em;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        input[type="submit"],
        input[type="reset"] {
            padding: 10px 15px;
            font-size: 1em;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        input[type="reset"] {
            background-color: #6c757d;
        }
        input[type="reset"]:hover {
            background-color: #5a6268;
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
        .image-preview {
            text-align: center;
            margin-bottom: 20px;
        }
        .image-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Product</h1>
        <a href="view_products.php" class="back-button">Back to Products</a>
        <form method="POST" enctype="multipart/form-data">
            <div class="image-preview">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            
            <label for="price">Price (ZMW)</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
            
            <label for="image">Change Image (optional)</label>
            <input type="file" id="image" name="image" accept="image/*">
            
            <input type="submit" value="Update Product">
            <input type="reset" value="Reset">
        </form>
    </div>
</body>
</html>
