<?php


header('Access-Control-Allow-Origin: *');

// Allow specific HTTP methods
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// Allow specific HTTP headers
header('Access-Control-Allow-Headers: Content-Type');

// Allow credentials (cookies, authorization headers, etc.)
header('Access-Control-Allow-Credentials: true');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getRooms') {
    $result_rooms = $conn->query("SELECT * FROM rooms");

    // Fetch data and encode it as JSON
    $rooms = [];
    while ($row = $result_rooms->fetch_assoc()) {
        $rooms[] = $row;
    }

    echo json_encode($rooms);
} else {
    // Handle other requests or provide an error response
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>



