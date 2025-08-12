<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

/**
 * Send an email using SMTP.
 *
 * @param array $recipients Array of recipient email addresses
 * @param string $subject Email subject
 * @param string $message Email body content (HTML supported)
 * @return bool|string Returns true on success, or an error message on failure
 */
function sendEmail($recipients, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
         // Enable debugging (set to 2 for detailed logs)
        //  $mail->SMTPDebug = 2;
        //  $mail->Debugoutput = 'html';

        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'mail.oneplusafrica.com';  
        $mail->SMTPAuth   = true;
        $mail->Username   = 'snackoh-bakers@oneplusafrica.com'; 
        $mail->Password   = 'snackoh-bakers';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465; 

        // Sender Information
        $mail->setFrom('snackoh-bakers@oneplusafrica.com', 'snack-oh bakers');

        // Recipients
        foreach ($recipients as $email) {
            $mail->addAddress($email);
        }

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        // Debugging logs
        file_put_contents('mail_log.txt', "Sending email to: " . json_encode($recipients) . "\n", FILE_APPEND);

        // Send Email
        if ($mail->send()) {
            file_put_contents('mail_log.txt', "Email sent successfully\n", FILE_APPEND);
            return true;
        } else {
            file_put_contents('mail_log.txt', "Email sending failed: " . $mail->ErrorInfo . "\n", FILE_APPEND);
            return "Email sending failed.";
        }

    } catch (Exception $e) {
        file_put_contents('mail_log.txt', "Mailer Error: " . $mail->ErrorInfo . "\n", FILE_APPEND);
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
