<?php
require './auth.php';

function createTables($conn)
{
    $create_messages_table = "CREATE TABLE IF NOT EXISTS chat_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender_email VARCHAR(255),
        sender_name VARCHAR(255),
        message TEXT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        is_read BOOLEAN DEFAULT FALSE
    )";

    if (!mysqli_query($conn, $create_messages_table)) {
        return "Error creating chat_messages table: " . mysqli_error($conn);
    }

    $create_likes_table = "CREATE TABLE IF NOT EXISTS chat_likes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message_id INT NOT NULL,
        user_email VARCHAR(255) NOT NULL,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (message_id) REFERENCES chat_messages(id) ON DELETE CASCADE,
        UNIQUE KEY unique_like (message_id, user_email)
    )";

    if (!mysqli_query($conn, $create_likes_table)) {
        return "Error creating chat_likes table: " . mysqli_error($conn);
    }

    return "Tables created successfully!";
}

function getMessages($conn, $last_id = 0)
{
    $query = "SELECT m.*, 
              COUNT(l.id) as like_count,
              EXISTS(SELECT 1 FROM chat_likes WHERE message_id = m.id AND user_email = '{$_SESSION['email']}') as is_liked
              FROM chat_messages m 
              LEFT JOIN chat_likes l ON m.id = l.message_id 
              WHERE m.id > $last_id 
              GROUP BY m.id 
              ORDER BY m.timestamp ASC";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return ['error' => 'Database error: ' . mysqli_error($conn)];
    }

    $messages = [];
    while ($message = mysqli_fetch_assoc($result)) {
        $messages[] = [
            'id' => $message['id'],
            'sender_email' => $message['sender_email'],
            'sender_name' => $message['sender_name'],
            'message' => $message['message'],
            'timestamp' => $message['timestamp'],
            'is_sender' => $message['sender_email'] === $_SESSION['email'],
            'like_count' => (int) $message['like_count'],
            'is_liked' => (bool) $message['is_liked']
        ];
    }

    return $messages;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if this is a table creation request
    if (isset($_GET['action']) && $_GET['action'] === 'create_tables') {
        echo createTables($conn);
        exit();
    }

    if (!isset($_SESSION['email'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }

    $last_id = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;
    $messages = getMessages($conn, $last_id);

    header('Content-Type: application/json');
    echo json_encode($messages);
}
?>