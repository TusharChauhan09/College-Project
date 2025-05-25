<?php
require './auth.php';

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$message_id = isset($data['message_id']) ? (int) $data['message_id'] : 0;
$user_email = $_SESSION['email'];

if ($message_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid message ID']);
    exit();
}

$check_message = "SELECT id FROM chat_messages WHERE id = $message_id";
$message_result = mysqli_query($conn, $check_message);

if (!$message_result || mysqli_num_rows($message_result) === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Message not found']);
    exit();
}

// Check if user has already liked the message
$check_like = "SELECT id FROM chat_likes WHERE message_id = $message_id AND user_email = '$user_email'";
$like_result = mysqli_query($conn, $check_like);

if (mysqli_num_rows($like_result) > 0) {
    // Unlike the message
    $unlike_query = "DELETE FROM chat_likes WHERE message_id = $message_id AND user_email = '$user_email'";
    if (mysqli_query($conn, $unlike_query)) {
        echo json_encode(['action' => 'unliked']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error unliking message']);
    }
} else {
    // Like the message
    $like_query = "INSERT INTO chat_likes (message_id, user_email) VALUES ($message_id, '$user_email')";
    if (mysqli_query($conn, $like_query)) {
        echo json_encode(['action' => 'liked']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error liking message']);
    }
}
?>