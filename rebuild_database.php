<?php
// rebuild_database.php - This script will completely rebuild your database

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Database Rebuild Tool</h1>";

// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$database = "college-project";

// Step 1: Connect to MySQL server (without specifying a database)
echo "<h2>Step 1: Connecting to MySQL server</h2>";
$conn = new mysqli($server, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully.<br>";

// Step 2: Drop the existing database if it exists
echo "<h2>Step 2: Dropping existing database</h2>";
$sql = "DROP DATABASE IF EXISTS `$database`";
if ($conn->query($sql) === TRUE) {
    echo "Database '$database' dropped successfully (or did not exist).<br>";
} else {
    die("Error dropping database: " . $conn->error);
}

// Step 3: Create a fresh database
echo "<h2>Step 3: Creating fresh database</h2>";
$sql = "CREATE DATABASE `$database`";
if ($conn->query($sql) === TRUE) {
    echo "Database '$database' created successfully.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Step 4: Select the new database
echo "<h2>Step 4: Selecting database</h2>";
$conn->select_db($database);
echo "Selected database: $database<br>";

// Step 5: Create all tables in the correct order
echo "<h2>Step 5: Creating tables</h2>";

// Table: user
echo "Creating 'user' table... ";
$sql = "CREATE TABLE `user` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status INT DEFAULT 0,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    permission INT DEFAULT 0
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Success!<br>";
} else {
    die("Error: " . $conn->error);
}

// Table: application
echo "Creating 'application' table... ";
$sql = "CREATE TABLE `application` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    a_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    a_email VARCHAR(255) NOT NULL,
    a_role VARCHAR(255) NOT NULL,
    a_profile VARCHAR(255),
    a_resume VARCHAR(255),
    a_about TEXT,
    a_post TEXT
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Success!<br>";
} else {
    die("Error: " . $conn->error);
}

// Table: post
echo "Creating 'post' table... ";
$sql = "CREATE TABLE `post` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    p_email VARCHAR(255) NOT NULL,
    p_name VARCHAR(255) NOT NULL,
    p_profile VARCHAR(255),
    p_resume VARCHAR(255),
    p_about TEXT,
    p_post TEXT,
    p_date DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Success!<br>";
} else {
    die("Error: " . $conn->error);
}

// Table: chat_messages
echo "Creating 'chat_messages' table... ";
$sql = "CREATE TABLE `chat_messages` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_email VARCHAR(255),
    sender_name VARCHAR(255),
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Success!<br>";
} else {
    die("Error: " . $conn->error);
}

// Table: chat_likes
echo "Creating 'chat_likes' table... ";
$sql = "CREATE TABLE `chat_likes` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_id INT NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (message_id) REFERENCES chat_messages(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (message_id, user_email)
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Success!<br>";
} else {
    die("Error: " . $conn->error);
}

// Step 6: Verify all tables
echo "<h2>Step 6: Verifying tables</h2>";
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    echo "Tables in database:<br>";
    echo "<ul>";
    while($row = $result->fetch_row()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in database!";
}

// Step 7: Create a test user (optional)
echo "<h2>Step 7: Creating a test user</h2>";
$name = "Test User";
$email = "test@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);
$permission = 1; // Recruiter
$status = 1;

$sql = "INSERT INTO `user` (name, email, password, status, permission) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssis", $name, $email, $password, $status, $permission);

if ($stmt->execute()) {
    echo "Test user created successfully:<br>";
    echo "Email: test@example.com<br>";
    echo "Password: password123<br>";
} else {
    echo "Error creating test user: " . $stmt->error;
}

// Close connection
$conn->close();

echo "<h2>Database Rebuild Complete!</h2>";
echo "<p>Your database has been completely rebuilt with all required tables.</p>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
?>
