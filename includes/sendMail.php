<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendMail($to, $subject, $templatePath, $placeholders = [],$embeddedImages = []) {
    $mail = new PHPMailer(true);

    try {
  
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_SECURE;
        $mail->Port       = MAIL_PORT;

        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;

        if (!file_exists($templatePath)) {
            throw new Exception("Template not found: " . $templatePath);
        }
        $message = file_get_contents($templatePath);

        foreach ($embeddedImages as $cid => $path) {
            if (file_exists($path)) {
                $mail->addEmbeddedImage($path, $cid);
                $message = str_replace("{{" . strtoupper($cid) . "}}", "cid:" . $cid, $message);
            }
        }

        foreach ($placeholders as $key => $value) {
            $message = str_replace("{{" . strtoupper($key) . "}}", $value, $message);
        }

        $mail->Body = $message;

        $mail->send();

        return true;

    } catch (Exception $e) {
        return "Mailer Error: {$mail->ErrorInfo}";
    }
}
