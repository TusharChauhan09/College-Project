<?php
require './auth.php';

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// Get last message ID from request
$last_id = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;

// Get new messages
$query = "SELECT * FROM chat_messages WHERE id > $last_id ORDER BY timestamp ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . mysqli_error($conn)]);
    exit();
}

$messages = [];
while ($message = mysqli_fetch_assoc($result)) {
    $messages[] = [
        'id' => $message['id'],
        'sender_email' => $message['sender_email'],
        'sender_name' => $message['sender_name'],
        'message' => $message['message'],
        'timestamp' => $message['timestamp'],
        'is_sender' => $message['sender_email'] === $_SESSION['email']
    ];
}

// Return messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>