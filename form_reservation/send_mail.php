<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

// Récupérer les données du formulaire (vous pouvez les récupérer depuis la base de données si nécessaire)
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];

// Créer le corps du message
$message = "Cher $first_name $last_name,\n\nMerci pour votre réservation. Votre chambre est en attente de confirmation.";

// Configurer PHPMailer
if(isset($_POST["send"])){
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP (adaptés à votre configuration)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sbouzid677@gmail.com';
    $mail->Password   = 'mpay wkbv xytq nhes';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Destinataire
    $mail->setFrom('sbouzid677@gmail.com', 'saif');
    $mail->addAddress($email, "$first_name $last_name");

    // Contenu du message
    $mail->isHTML(false);
    $mail->Subject = 'Votre reservation a ete effectuee avec succes ';
    $mail->Body    = $message;

    // Envoyer le message
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}}
?>
