<?php
require 'db.php';

$id = $_GET['id'];

$stmt = $mysqli->prepare('SELECT * FROM products WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

echo json_encode($product);
?>
