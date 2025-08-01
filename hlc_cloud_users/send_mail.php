<?php
$to = "ajinkya@lealsolution.com";         // Receiver's email
$subject = "Test Mail from PHP";       // Email subject
$message = "Hello,\nThis is a test email sent from PHP script."; // Email body
$headers = "From: suraj@lealsolution.com"; // Sender's email
$data = file_get_contents('https://demo-hlccloud.lealsolution.com/demo-hlccloud/subscription_mail.php'); // or your server URL
echo $data;
if (mail($to, $subject, $message, $headers)) {
     
} else {
    echo "Failed to send mail.";
}
?>
