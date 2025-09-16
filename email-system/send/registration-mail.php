<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// STEP 1: Generate a unique token
$token = bin2hex(random_bytes(16));

// STEP 2: Prepare user data
$toEmail = "user@example.com"; // REPLACE with user's email
$toName  = "User Name"; // Optional - user's name
$verifyLink = "https://thelivemodels.com/verify.php?token=$token";

// STEP 3: Load the HTML template and insert verify link
$template = file_get_contents("emails/register.html"); // path to your template
$emailBody = str_replace('{verify_link}', $verifyLink, $template);

// STEP 4: Configure PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';  // Change to your SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'no-reply@thelivemodels.com'; // Your SMTP email
    $mail->Password   = 'your_password_here';         // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Email headers
    $mail->setFrom('no-reply@thelivemodels.com', 'The Live Models');
    $mail->addAddress($toEmail, $toName);
    $mail->Subject = 'Verify Your Email – The Live Models';

    // Email content
    $mail->isHTML(true);
    $mail->Body = $emailBody;

    // Send the email
    $mail->send();
    echo 'Verification email has been sent.';

    // Optionally: Save the token to database for verification
    // Example: INSERT INTO email_tokens (email, token, created_at) VALUES (...)
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
