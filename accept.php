<?php
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
    $mail->Subject = 'Application Accepted - Congratulations';
    $mail->Body = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 5px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="color: #0a66c2; margin-bottom: 5px;">Congratulations!</h2>
            <p style="color: #666; font-size: 16px;">Your application has been accepted</p>
        </div>
        
        <div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
            <p style="margin-bottom: 15px;">Dear Applicant,</p>
            
            <p style="margin-bottom: 15px;">We are pleased to inform you that your application has been reviewed and accepted. Your qualifications and experience align well with what we are looking for.</p>
            
            <p style="margin-bottom: 15px;">Our team will contact you shortly with further details regarding the next steps in the process.</p>
            
            <p>Thank you for your interest in our organization.</p>
        </div>
        
        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e0e0e0; color: #888; font-size: 12px;">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>';
    $mail->AltBody = 'Congratulations! Your application has been accepted. We will contact you shortly with further details regarding the next steps in the process. Thank you for your interest in our organization.';

    $mail->send();
    echo json_encode(["status" => "success", "message" => "Email sent successfully to: $receiver"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Email could not be sent. Error: {$mail->ErrorInfo}"]);
}
?>