<?php
// require './auth.php';
header("Content-Type: application/json");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_POST['x'])) {
    $receiver = $_POST['x'];
} else {
    echo json_encode(["status" => "error", "message" => "No email provided"]);
    exit;
}

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tusharchauhan0912@gmail.com';
    $mail->Password = 'jgkxnpulopgdqlvx';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('tusharchauhan0912@gmail.com', 'tushar');
    $mail->addAddress($receiver);

    $mail->isHTML(true);
    $mail->Subject = 'Application Status Update';
    $mail->Body = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 5px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="color: #555; margin-bottom: 5px;">Application Status Update</h2>
            <p style="color: #666; font-size: 16px;">Thank you for your application</p>
        </div>
        
        <div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
            <p style="margin-bottom: 15px;">Dear Applicant,</p>
            
            <p style="margin-bottom: 15px;">Thank you for your interest in our organization and for taking the time to submit your application.</p>
            
            <p style="margin-bottom: 15px;">After careful consideration of your qualifications and our current requirements, we regret to inform you that we will not be moving forward with your application at this time.</p>
            
            <p style="margin-bottom: 15px;">Please note that this decision does not reflect on your skills or qualifications. We received many applications from qualified candidates, and our selection process is based on specific criteria and current organizational needs.</p>
            
            <p style="margin-bottom: 15px;">We encourage you to apply for future opportunities that align with your skills and experience.</p>
            
            <p>We wish you success in your job search and professional endeavors.</p>
        </div>
        
        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e0e0e0; color: #888; font-size: 12px;">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>';
    $mail->AltBody = 'Thank you for your application. After careful consideration, we regret to inform you that we will not be moving forward with your application at this time. We encourage you to apply for future opportunities that align with your skills and experience. We wish you success in your job search and professional endeavors.';

    $mail->send();
    echo json_encode(["status" => "success", "message" => "Rejection email sent successfully to: $receiver"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Email could not be sent. Error: {$mail->ErrorInfo}"]);
}

// Database update
// Uncomment and define $conn before using this code
/*
$check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$receiver'");

if(mysqli_num_rows($check) > 0) {
   $query = mysqli_query($conn, "UPDATE user SET 
       status = 2
       WHERE email = '$receiver'");
}
else{
   echo " Failed  ";
}
*/
?>