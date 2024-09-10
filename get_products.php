<?php
require 'db.php';

$result = $mysqli->query('SELECT * FROM products');
$products = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($products);
?>
