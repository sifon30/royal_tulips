<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$sql = "SELECT Reservation.*, Client.Nom AS NomClient, Client.Prenom AS PrenomClient, Chambre.NumCh, Chambre.TypeCh FROM Reservation
        INNER JOIN Client ON Reservation.IdC = Client.IdC
        INNER JOIN Chambre ON Reservation.NumCh = Chambre.NumCh";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .delete-icon {
            color: #e74c3c;
            font-size: 18px;
            cursor: pointer;
        }

        .delete-icon:hover {
            color: #c0392b;
        }

</style>

</head>
<body>

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Nom Client</th>
                <th>Date Arrivée</th>
                <th>Date Départ</th>
                <th>Nombre de Personnes</th>
                <th>Numéro de Chambre</th>
                <th>Type de Chambre</th>
                <th>Supprimer</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['NomClient']} {$row['PrenomClient']}</td>
                <td>{$row['DateArrive']}</td>
                <td>{$row['DateDepart']}</td>
                <td>{$row['NumPer']}</td>
                <td>{$row['NumCh']}</td>
                <td>{$row['TypeCh']}</td>
                <td><a href='supp_reservation.php?id={$row['NumRes']}'>Supprimer</a></td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Aucune réservation trouvée.";
}

$conn->close();
?>
</body>
</html>
