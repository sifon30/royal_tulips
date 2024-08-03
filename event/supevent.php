<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> supprimer un événement</title>
    <!-- Ajoutez votre lien CSS ici -->
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

form {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

h2 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #e74c3c;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #c0392b;
}

input[readonly] {
    background-color: #ecf0f1;
    cursor: not-allowed;
}

/* Optional: Add some additional styling for better visual appearance if needed */
form {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

</style>
<body>

<?php
// Inclure le code de connexion à la base de données

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}




// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si la clé 'event_id' existe dans le tableau $_POST
    if (isset($_POST['event_id'])) {
        $eventId = $_POST['event_id'];

        // Vérifier si l'événement existe
        $checkSql = "SELECT * FROM events WHERE id = $eventId";
        $checkResult = $conn->query($checkSql);

        if($checkResult){
            if($checkResult->num_rows > 0){
                $row = $checkResult->fetch_assoc();

                $eventName = $row['title'];
                $eventimg = $row['img'];
                $eventAvailability = $row['availability'];
                $eventStatus = $row['status'];
                $eventDate = $row['date'];

                if(isset ($_POST['delete'])){
               
                    $deleteSql = "DELETE FROM events WHERE id=$eventId";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "Événement supprimé avec succès.";
                    } else {
                        echo "Erreur lors de la suppression de l'événement : " . $conn->error;
                    }
                }
            } else {
                echo "Aucun événement trouvé avec cet identifiant.";
            }
        } else {
            echo "Erreur lors de la vérification de l'événement : " . $conn->error;
        }
    } else {
        echo "ID d'événement non spécifié.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<h2> supprimer un événement</h2>

<!-- Formulaire pour saisir l'ID de l'événement -->
<form method="post" action="">
    <label for="event_id">ID de l'événement :</label>
    <input type="text" name="event_id" required>
    <br>
    <input type="submit" name="submit" value="Soumettre">
</form>

<?php
// Afficher le formulaire de modification par défaut
if (isset($eventName)) {
    ?>
    <br>

        <!-- Afficher le formulaire de modification -->
        <form method="post" action="">
        <!-- Ajoutez un champ caché pour l'ID de l'événement -->
        <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
        
        <label for=""> Nom d'événement :</label>
        <input type="text" name="" value="<?php echo $eventName; ?>" required>
        <br>
        <label for=""> Disponibilité :</label>
        <input type="text" name="" value="<?php echo $eventAvailability; ?>" required>
        <br>
        <label for=""> Statut :</label>
        <input type="text" name="" value="<?php echo $eventStatus; ?>" required>
        <br>
        <label for=""> Date :</label>
        <input type="text" name="" value="<?php echo $eventDate; ?>" required>
        <br>
      
    </form>

    <br>

    <!-- Afficher le formulaire de suppression -->
    <form method="post" action="">
    <!-- Ajoutez un champ caché pour l'ID de l'événement -->
    <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
    <input type="submit" name="delete" value="Supprimer l'événement" onclick="return confirm('Voulez-vous vraiment supprimer cet événement?');">
</form>
    <?php
}
?>

</body>
</html>
