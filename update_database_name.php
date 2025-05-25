<?php
// update_database_name.php - This script will update all PHP files to use the new database name

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Database Name Update Tool</h1>";

// Database names
$old_db = "college-project";
$new_db = "college_project";

// Directory to scan
$directory = __DIR__;

// Get all PHP files
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$updated_files = [];
$error_files = [];

echo "<h2>Updating database name in PHP files</h2>";
echo "<p>Changing from <strong>$old_db</strong> to <strong>$new_db</strong></p>";

// Skip these files
$skip_files = [
    'update_database_name.php',
    'fix_tablespace.php',
    'rebuild_database.php',
    'rebuild_tables.php',
    'test_database.php',
    'setup_database.php'
];

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filename = $file->getFilename();
        
        // Skip this file and other utility files
        if (in_array($filename, $skip_files)) {
            continue;
        }
        
        $filepath = $file->getPathname();
        $content = file_get_contents($filepath);
        
        // Check if the file contains the old database name
        if (strpos($content, $old_db) !== false) {
            // Replace the database name
            $new_content = str_replace($old_db, $new_db, $content);
            
            // Write the updated content back to the file
            if (file_put_contents($filepath, $new_content)) {
                $updated_files[] = $filepath;
            } else {
                $error_files[] = $filepath;
            }
        }
    }
}

// Display results
if (!empty($updated_files)) {
    echo "<h3>Updated Files:</h3>";
    echo "<ul>";
    foreach ($updated_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No files were updated.</p>";
}

if (!empty($error_files)) {
    echo "<h3>Files with Errors:</h3>";
    echo "<ul>";
    foreach ($error_files as $file) {
        echo "<li>" . basename($file) . "</li>";
    }
    echo "</ul>";
}

// Create a simple database connection test
echo "<h2>Testing Database Connection</h2>";

// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$database = $new_db;

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo "<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color: green;'>Connected to database successfully!</p>";
    
    // Check if tables exist
    $result = $conn->query("SHOW TABLES");
    if ($result->num_rows > 0) {
        echo "<p>Tables in database:</p>";
        echo "<ul>";
        while($row = $result->fetch_row()) {
            echo "<li>" . $row[0] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No tables found in database!</p>";
        
        // Offer to run the fix_tablespace.php script
        echo "<p><a href='fix_tablespace.php'>Click here to create tables</a></p>";
    }
    
    $conn->close();
}

echo "<h2>Update Complete!</h2>";
echo "<p>Your PHP files have been updated to use the new database name: <strong>$new_db</strong></p>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
?>
