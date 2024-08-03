<?php
include 'send_mail.php';
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$arrival_date = $_POST["arrival_date"];
$departure_date = $_POST["departure_date"];
$num_persons = $_POST["num_persons"];
$num_rooms = $_POST["num_rooms"];
$type_chamber = $_POST["type_chamber"];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$sql_client = "INSERT INTO Client (Nom, Prenom, Email, Pays, NumTel) VALUES ('$last_name', '$first_name', '$email', '$country', '$phone')";
$conn->query($sql_client);
$client_id = $conn->insert_id;

$sql_chambre = "INSERT INTO Chambre (TypeCh, NombreCh) VALUES ('$type_chamber', '$num_rooms')";
$conn->query($sql_chambre);
$num_chambre = $conn->insert_id; 

$sql_reservation = "INSERT INTO Reservation (DateArrive, DateDepart, DureSejour, NumPer, IdC, NumCh) VALUES ('$arrival_date', '$departure_date', DATEDIFF('$departure_date', '$arrival_date'), '$num_persons', '$client_id', '$num_chambre')";
$conn->query($sql_reservation);





// Redirection vers une page de confirmation ou autre
header('Location: confirmation_page.php');
exit;





$conn->close();



?>
