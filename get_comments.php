<?require 'db.php';


$product_id = $_GET['product_id'];

$stmt = $mysqli->prepare('SELECT * FROM comments WHERE product_id = ?');
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$comments = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($comments);
?>
