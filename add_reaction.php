<?php
include 'db.php';

// Retrieve post_id and emoji from POST request
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$emoji = isset($_POST['emoji']) ? $_POST['emoji'] : '';

if ($post_id > 0 && !empty($emoji)) {
    // Prepare SQL to insert reaction
    $sql = "INSERT INTO reactions (post_id, emoji) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('is', $post_id, $emoji);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Reaction added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add reaction']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}

$mysqli->close();
?>
