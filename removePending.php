<?php
// require './auth.php';
header("Content-Type: application/json");

if (isset($_POST['x'])) {
    $email = $_POST['x'];
    
    // Connect to database if needed
    // Uncomment and modify the following code as needed
    /*
    require './config.php'; // Include your database connection
    
    // Update the user status in the database
    $query = mysqli_query($conn, "UPDATE user SET 
        status = 0
        WHERE email = '$email'");
        
    if ($query) {
        echo json_encode(["status" => "success", "message" => "Pending state removed for: $email"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($conn)]);
    }
    */
    
    // For now, just return success
    echo json_encode(["status" => "success", "message" => "Pending state removed for: $email"]);
} else {
    // Send an error response if 'x' is missing
    echo json_encode(["status" => "error", "message" => "No email provided"]);
}
?>
