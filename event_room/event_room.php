
<?php
// Connexion à la base de données (à remplacer par vos propres informations)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération et affichage des chambres
$result_rooms = $conn->query("SELECT * FROM rooms");

while ($row = $result_rooms->fetch_assoc()) {
    echo '<div class="room-item">';
    echo '<img src="' . $row['img'] . '" alt="">';
    echo '<div class="desc">';
    echo '<h3>' . $row['title'] . '</h3>';
    echo '<p>' . $row['description'] . '</p>';
    echo '</div></div>';
}

// Récupération et affichage des événements
$result_events = $conn->query("SELECT * FROM events");

while ($row = $result_events->fetch_assoc()) {
    echo '<div class="event">';
    echo '<img src="' . $row['img'] . '" alt="' . $row['title'] . ' Image">';
    echo '<div class="event-details">';
    echo '<h3>' . $row['title'] . '</h3>';
    echo '<p>Availability: ' . $row['availability'] . '</p>';
    echo '<p>Status: ' . $row['status'] . '</p>';
    echo '<p>Date: ' . $row['date'] . '</p>';
    echo '<button class="reserve-event-btn">Reserve Now</button>';
    echo '</div></div>';
}

// Fermeture de la connexion
$conn->close();
?>

<style>
    .our_room {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .room-item, .event {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .room-item img, .event img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .room-item h3, .event h3 {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .reserve-event-btn {
            background-color: #3498db;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
</style>