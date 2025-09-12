<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/phpmailer/vendor/autoload.php';

class MailerService
{
    public static function sendWelcomEmail($name, $email)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                         // Disable debug output for production
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            $mail->Username = 'rayvon.andeche@strathmore.edu';          // SMTP username (corrected email)
            $mail->Password = 'rzog henx tauv aclh';                    // SMTP password (use App Password for Gmail)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port = 465;                                          // TCP port to connect to

            // Recipients
            $mail->setFrom('noreply@task-app.com', 'Task App System');
            $mail->addAddress($email, $name);
            
            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Welcome to Task App';
            $mail->Body = '
                <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                    <p>Dear ' . htmlspecialchars($name) . ',</p>
                    <p>Welcome to Task App! Your registration has been completed successfully.</p>
                </div>
            ';
            $mail->AltBody = 'Dear ' . $name . ', Welcome to Task App! Your registration has been completed successfully.';

            $mail->send();
            // Email sent successfully - no output needed
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            throw $e; // Re-throw the exception to let the controller handle it
        }
    }
}
