<?php
// test_database.php - A simple script to test database connection and table creation

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Database Test</h1>";

// Try to connect to the database
echo "<h2>Testing Database Connection</h2>";
$server = "localhost";
$username = "root";
$password = "";
$database = "college-project";

// Create connection without database first
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully!<br>";

// Check if database exists, create if not
$result = $conn->query("SHOW DATABASES LIKE '$database'");
if ($result->num_rows == 0) {
    echo "Database '$database' does not exist. Creating it now...<br>";
    $sql = "CREATE DATABASE `$database`";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully!<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }
} else {
    echo "Database '$database' already exists.<br>";
}

// Select the database
$conn->select_db($database);
echo "Selected database: $database<br>";

// Function to check if a table exists
function tableExists($conn, $tableName) {
    $result = $conn->query("SHOW TABLES LIKE '$tableName'");
    return $result->num_rows > 0;
}

// Check and create tables
$tables = [
    'user' => "CREATE TABLE `user` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        status INT DEFAULT 0,
        date DATETIME DEFAULT CURRENT_TIMESTAMP,
        permission INT DEFAULT 0
    )",
    
    'application' => "CREATE TABLE `application` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        a_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        a_email VARCHAR(255) NOT NULL,
        a_role VARCHAR(255) NOT NULL,
        a_profile VARCHAR(255),
        a_resume VARCHAR(255),
        a_about TEXT,
        a_post TEXT
    )",
    
    'post' => "CREATE TABLE `post` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        p_email VARCHAR(255) NOT NULL,
        p_name VARCHAR(255) NOT NULL,
        p_profile VARCHAR(255),
        p_resume VARCHAR(255),
        p_about TEXT,
        p_post TEXT,
        p_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )",
    
    'chat_messages' => "CREATE TABLE `chat_messages` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender_email VARCHAR(255),
        sender_name VARCHAR(255),
        message TEXT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        is_read BOOLEAN DEFAULT FALSE
    )",
    
    'chat_likes' => "CREATE TABLE `chat_likes` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message_id INT NOT NULL,
        user_email VARCHAR(255) NOT NULL,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (message_id) REFERENCES chat_messages(id) ON DELETE CASCADE,
        UNIQUE KEY unique_like (message_id, user_email)
    )"
];

echo "<h2>Testing Table Creation</h2>";
foreach ($tables as $tableName => $createSQL) {
    if (tableExists($conn, $tableName)) {
        echo "Table '$tableName' already exists.<br>";
        
        // Check if there are any issues with the table
        $result = $conn->query("REPAIR TABLE `$tableName`");
        $row = $result->fetch_assoc();
        if ($row['Msg_text'] == "OK") {
            echo "Table '$tableName' is OK.<br>";
        } else {
            echo "Repairing table '$tableName': " . $row['Msg_text'] . "<br>";
            
            // If repair doesn't work, try recreating the table
            echo "Dropping and recreating table '$tableName'...<br>";
            $conn->query("DROP TABLE IF EXISTS `$tableName`");
            if ($conn->query($createSQL)) {
                echo "Table '$tableName' recreated successfully!<br>";
            } else {
                echo "Error recreating table '$tableName': " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Table '$tableName' does not exist. Creating it now...<br>";
        if ($conn->query($createSQL)) {
            echo "Table '$tableName' created successfully!<br>";
        } else {
            echo "Error creating table '$tableName': " . $conn->error . "<br>";
        }
    }
}

echo "<h2>Database Setup Complete!</h2>";
echo "<p>All required tables have been created or verified.</p>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";

$conn->close();
?>
