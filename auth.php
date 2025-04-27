<?php
session_start();
include 'dbconnect.php'; 

// Check if session is set
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error in prepare: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$user = $result->fetch_assoc();
?>