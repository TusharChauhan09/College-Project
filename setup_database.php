<?php
// setup_database.php - Run this file once to set up all database tables

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "college-project"; // Make sure this matches your actual database name

// Create connection
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `$database`";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);

// Drop tables if they exist (to ensure clean setup)
$tables = ["chat_messages", "chat_likes", "user", "application", "post"];
foreach ($tables as $table) {
    $conn->query("DROP TABLE IF EXISTS `$table`");
}

// Create tables in the correct order (respecting foreign key constraints)

// Table: user
$create_user_table = "CREATE TABLE `user` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status INT DEFAULT 0,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    permission INT DEFAULT 0
)";

if (!$conn->query($create_user_table)) {
    die("Error creating user table: " . $conn->error);
}
echo "User table created successfully<br>";

// Table: application
$create_application_table = "CREATE TABLE `application` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    a_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    a_email VARCHAR(255) NOT NULL,
    a_role VARCHAR(255) NOT NULL,
    a_profile VARCHAR(255),
    a_resume VARCHAR(255),
    a_about TEXT,
    a_post TEXT
)";

if (!$conn->query($create_application_table)) {
    die("Error creating application table: " . $conn->error);
}
echo "Application table created successfully<br>";

// Table: post
$create_post_table = "CREATE TABLE `post` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    p_email VARCHAR(255) NOT NULL,
    p_name VARCHAR(255) NOT NULL,
    p_profile VARCHAR(255),
    p_resume VARCHAR(255),
    p_about TEXT,
    p_post TEXT,
    p_date DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($create_post_table)) {
    die("Error creating post table: " . $conn->error);
}
echo "Post table created successfully<br>";

// Table: chat_messages
$create_messages_table = "CREATE TABLE `chat_messages` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_email VARCHAR(255),
    sender_name VARCHAR(255),
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
)";

if (!$conn->query($create_messages_table)) {
    die("Error creating chat_messages table: " . $conn->error);
}
echo "Chat_messages table created successfully<br>";

// Table: chat_likes
$create_likes_table = "CREATE TABLE `chat_likes` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_id INT NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (message_id) REFERENCES chat_messages(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (message_id, user_email)
)";

if (!$conn->query($create_likes_table)) {
    die("Error creating chat_likes table: " . $conn->error);
}
echo "Chat_likes table created successfully<br>";

echo "<h2>All database tables have been created successfully!</h2>";
echo "<p>You can now <a href='index.php'>go to the homepage</a>.</p>";

$conn->close();
?>
