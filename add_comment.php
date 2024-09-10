<?php
require 'db.php';

$product_id = $_POST['product_id'];
$comment = $_POST['comment'];

$stmt = $mysqli->prepare('INSERT INTO comments (product_id, comment) VALUES (?, ?)');
$stmt->bind_param('is', $product_id, $comment);
$stmt->execute();

echo json_encode(['success' => true]);
?>
