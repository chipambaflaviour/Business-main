<?php
require 'db.php';

$id = $_POST['id'];

$stmt = $mysqli->prepare('DELETE FROM products WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

echo json_encode(['success' => true]);
?>
