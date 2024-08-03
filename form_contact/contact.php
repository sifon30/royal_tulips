



<?php 
include 'contact_send.php';
// Connexion à la base de données (remplacez les valeurs par les vôtres)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $phone_number = $_POST["Phone_Number"];
    $message = $_POST["Message"];
    if (empty($name) || empty($email) || empty($phone_number) || empty($message)) {
        echo "Veuillez remplir tous les champs du formulaire.";}
        else{
    // Préparer la requête SQL d'insertion
    $sql = "INSERT INTO contacts (name, email, phone_number, message) VALUES ('$name', '$email', '$phone_number', '$message')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
       
                $contactMessage = "Nouveau message de contact:\n\nNom: $name\nEmail: $email\nTéléphone: $phone_number\nMessage: $message";
                sendContactEmail('sbouzid677@gmail.com', 'Destinataire', 'Nouveau message de contact', $contactMessage);
                echo '<script>window.location.href = "../event_room/hotel.php#contact";</script>';

    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;

    }
}
}
// Fermer la connexion à la base de données
$conn->close();
?>


