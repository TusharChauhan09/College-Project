<?php
session_start();
include 'dbconnect.php'; // Include database connection

// Check if session is set
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Validate if the user still exists in the database
$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
// Check if prepare() failed
if (!$stmt) {
    die("Error in prepare: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // User does not exist, destroy session and redirect
    session_destroy();
    header("Location: login.php");
    exit();
}

$user = $result->fetch_assoc(); // Fetch user data if needed
?>