<?php
require './auth.php';

$create_messages_table = "CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_email VARCHAR(255),
    sender_name VARCHAR(255),
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
)";

if (!mysqli_query($conn, $create_messages_table)) {
    die("Error creating chat_messages table: " . mysqli_error($conn));
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
    die("Error creating chat_likes table: " . mysqli_error($conn));
}

echo "Chat tables created successfully!";
?>