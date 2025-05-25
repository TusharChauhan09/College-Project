<?php
// fix_tablespace.php - This script will fix tablespace issues by using a different database name

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Database Tablespace Fix Tool</h1>";

// Database connection parameters
$server = "localhost";
$username = "root";
$password = "";
$old_database = "college-project";
$new_database = "college_project"; // Using underscore instead of hyphen

// Step 1: Connect to MySQL server (without specifying a database)
echo "<h2>Step 1: Connecting to MySQL server</h2>";
$conn = new mysqli($server, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully.<br>";

// Step 2: Create a new database with a different name
echo "<h2>Step 2: Creating new database</h2>";
$sql = "CREATE DATABASE IF NOT EXISTS `$new_database`";
if ($conn->query($sql) === TRUE) {
    echo "Database '$new_database' created successfully.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Step 3: Select the new database
echo "<h2>Step 3: Selecting new database</h2>";
$conn->select_db($new_database);
echo "Selected database: $new_database<br>";

// Step 4: Create all tables in the correct order
echo "<h2>Step 4: Creating tables</h2>";

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
    echo "Error: " . $conn->error . "<br>";
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
    echo "Error: " . $conn->error . "<br>";
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
    echo "Error: " . $conn->error . "<br>";
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
    echo "Error: " . $conn->error . "<br>";
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
    echo "Error: " . $conn->error . "<br>";
}

// Step 5: Verify all tables
echo "<h2>Step 5: Verifying tables</h2>";
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

// Step 6: Create a test user
echo "<h2>Step 6: Creating a test user</h2>";
$name = "Test User";
$email = "test@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);
$permission = 1; // Recruiter
$status = 1;

$sql = "INSERT INTO `user` (name, email, password, status, permission) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("sssis", $name, $email, $password, $status, $permission);
    
    if ($stmt->execute()) {
        echo "Test user created successfully:<br>";
        echo "Email: test@example.com<br>";
        echo "Password: password123<br>";
    } else {
        echo "Error creating test user: " . $stmt->error . "<br>";
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error . "<br>";
}

// Step 7: Create a configuration file with the new database name
echo "<h2>Step 7: Creating database configuration file</h2>";
$config_content = "<?php
// Database connection parameters
\$server = \"localhost\";
\$username = \"root\";
\$password = \"\";
\$database = \"$new_database\";

// Create connection
\$conn = new mysqli(\$server, \$username, \$password, \$database);

// Check connection
if (\$conn->connect_error) {
    die(\"Connection failed: \" . \$conn->connect_error);
}
?>";

$config_file = "../new/db_config.php";
if (file_put_contents($config_file, $config_content)) {
    echo "Configuration file created successfully.<br>";
} else {
    echo "Error creating configuration file.<br>";
}

// Close connection
$conn->close();

echo "<h2>Database Fix Complete!</h2>";
echo "<p>A new database has been created with all required tables.</p>";
echo "<p>You need to update your code to use the new database name: <strong>$new_database</strong></p>";
echo "<p>A configuration file has been created at: <strong>db_config.php</strong></p>";
echo "<p>Update your code to include this file instead of dbconnect.php</p>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Replace all instances of 'include \"dbconnect.php\";' with 'include \"db_config.php\";'</li>";
echo "<li>Or update your existing dbconnect.php file to use the new database name: $new_database</li>";
echo "<li>Then <a href='index.php'>Go to Homepage</a></li>";
echo "</ol>";
?>
