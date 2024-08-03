<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

// Récupérer les données du formulaire (vous pouvez les récupérer depuis la base de données si nécessaire)
$nom = $_POST["nom"];
    $email = $_POST["email"];
    if(isset($_POST["tel"])) {
        $tel = $_POST["tel"];
    } else {
        echo"erreur";
    }
    
  
// Créer le corps du message
$message = "Cher $nom,\n\nMerci pour votre réservation. Votre reservation est en attente de confirmation.";

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
    $mail->addAddress($email, "$nom");

    // Contenu du message
    $mail->isHTML(false);
    $mail->Subject = 'Votre reservation a ete effectuee avec succes ';
    $mail->Body    = $message;

    // Envoyer le message
    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
