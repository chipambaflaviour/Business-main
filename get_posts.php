<?php
include 'db.php';

// Fetch posts and their reaction counts
$sql = "SELECT p.id, p.title, p.content, p.image, 
               IFNULL(SUM(r.emoji = '👍'), 0) AS like_count,
               IFNULL(SUM(r.emoji = '🔗'), 0) AS share_count
        FROM posts p
        LEFT JOIN reactions r ON p.id = r.post_id
        GROUP BY p.id
        ORDER BY p.created_at DESC";
$result = $mysqli->query($sql);

$posts = array();
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

echo json_encode($posts);

$mysqli->close();
?>
