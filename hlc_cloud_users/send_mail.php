<?php
$to = "ajinkya@lealsolution.com";         // Receiver's email
$subject = "Test Mail from PHP";       // Email subject
$message = "Hello,\nThis is a test email sent from PHP script."; // Email body
$headers = "From: suraj@lealsolution.com"; // Sender's email

if (mail($to, $subject, $message, $headers)) {
    echo "Mail sent successfully.";
} else {
    echo "Failed to send mail.";
}
?>
