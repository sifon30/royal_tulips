<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "hotel_reservation");
if ($mysqli->connect_error) {
 die("Erreur de connexion à la base de données : " 
. $mysqli->connect_error);
}
echo "Connexion réussie <br/>";
?>