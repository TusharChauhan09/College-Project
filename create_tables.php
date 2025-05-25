<?php
// create_tables.php
// This file ensures all required tables exist in the database

// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$database = "college_project"; // Using underscore instead of hyphen to avoid tablespace issues

// Create connection
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `$database`";
if (!$conn->query($sql)) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);

// Function to check if a table exists
function tableExists($conn, $tableName) {
    $result = $conn->query("SHOW TABLES LIKE '$tableName'");
    return $result->num_rows > 0;
}

// Create tables if they don't exist

// Table: user
if (!tableExists($conn, 'user')) {
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
}

// Table: application
if (!tableExists($conn, 'application')) {
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
}

// Table: post
if (!tableExists($conn, 'post')) {
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
}

// Table: chat_messages
if (!tableExists($conn, 'chat_messages')) {
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
}

// Table: chat_likes
if (!tableExists($conn, 'chat_likes')) {
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
}

// Return the connection for use in other files
return $conn;
