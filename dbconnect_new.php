<?php
// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$database = "college_project"; // Make sure this matches your actual database name

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // If connection fails, try to create the database
    $temp_conn = new mysqli($server, $username, $password);
    
    if ($temp_conn->connect_error) {
        die("Connection failed: " . $temp_conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS `$database`";
    if ($temp_conn->query($sql) === TRUE) {
        $temp_conn->close();
        // Try connecting again
        $conn = new mysqli($server, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed after database creation: " . $conn->connect_error);
        }
    } else {
        die("Error creating database: " . $temp_conn->error);
    }
}

// Ensure all required tables exist
function ensure_tables_exist($conn) {
    // Check if user table exists
    $result = $conn->query("SHOW TABLES LIKE 'user'");
    if ($result->num_rows == 0) {
        // Tables don't exist, redirect to setup
        header("Location: setup_database.php");
        exit();
    }
}

// Only check tables if not already in setup page
if (!strpos($_SERVER['PHP_SELF'], 'setup_database.php')) {
    ensure_tables_exist($conn);
}
?>
