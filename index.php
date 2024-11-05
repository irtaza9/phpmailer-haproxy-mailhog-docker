<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

function sendEmails($numberOfEmails, $limit, $debug) {
    $emailsToSend = min($numberOfEmails, $limit);
    
    for ($i = 0; $i < $emailsToSend; $i++) {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = $debug; // Set debug level based on parameter
            $mail->isSMTP();
            $mail->Host = 'haproxy';
            $mail->Port = 2525;
            $mail->SMTPAuth = false;
            $mail->SMTPSecure = false;

            $mail->setFrom('testsender@gmail.com', 'Mailer');
            $mail->addAddress('testreceiver@gmail.com', 'Receiver');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject ' . ($i + 1);
            $mail->Body = 'This is the HTML message body <b>in bold!</b> - Email number ' . ($i + 1);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients - Email number ' . ($i + 1);

            $mail->send();
            echo 'Message ' . ($i + 1) . ' has been sent<br>';
        } catch (Exception $e) {
            echo "Message " . ($i + 1) . " could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        }
    }
}

// Get parameters from the URL
$numberOfEmails = isset($_GET['number']) ? intval($_GET['number']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 0;
$debug = isset($_GET['debug']) ? intval($_GET['debug']) : 0; // 0 for false, 1 for true

if ($numberOfEmails > 0 && $limit > 0) {
    sendEmails($numberOfEmails, $limit, $debug);
} else {
    echo "Please provide valid 'number' and 'limit' GET parameters.";
}
