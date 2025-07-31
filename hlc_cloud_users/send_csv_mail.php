<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Sample user data (you can fetch from MySQL)
$user_email = 'ajinkya@lealsolution.com';
$user_name = 'Ajinkya Dongare';

// 1. Create CSV content
$csv_data = [
    ['Username', 'Project ID', 'Module ID', 'Status', 'Subscription Start', 'Subscription End'],
    ['ajinkya123', 'P001', 'M001', 'Active', '2025-07-01', '2025-07-30']
];

$csv_file = 'subscription_report.csv';
$fp = fopen($csv_file, 'w');

foreach ($csv_data as $line) {
    fputcsv($fp, $line);
}
fclose($fp);

// 2. Send email with attachment
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'ajinkya@lealsolution.com'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ajinkya@lealsolution.com'; // Your SMTP username
    $mail->Password   = 'your_app_password';    // Use app-specific password if Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('ajinkya@lealsolution.com', 'HLC Cloud');
    $mail->addAddress($user_email, $user_name);

    // Attachments
    $mail->addAttachment($csv_file);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Subscription Report';
    $mail->Body    = "Hello $user_name,<br><br>Your subscription report is attached.<br><br>Regards,<br>HLC Cloud";

    $mail->send();
    echo "Email sent successfully to $user_email.";
} catch (Exception $e) {
    echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
