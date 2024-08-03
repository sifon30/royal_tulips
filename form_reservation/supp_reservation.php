<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Supprimer la réservation
    $sql_delete = "DELETE FROM Reservation WHERE NumRes = $reservationId";
    $conn->query($sql_delete);

    // Redirection vers la liste des réservations
    header("Location: list_reservation.php");
    exit();
}

$conn->close();
?>
