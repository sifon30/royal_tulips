<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendContactEmail($toEmail, $toName, $subject, $body) {
    
    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP (adaptez-les à votre configuration)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sbouzid677@gmail.com';
        $mail->Password   = 'mpay wkbv xytq nhes';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Destinataire
        $mail->setFrom('sbouzid677@gmail.com', 'saif');
        $mail->addAddress($toEmail, $toName);

        // Contenu du message
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Envoyer le message
        $mail->send();
       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
