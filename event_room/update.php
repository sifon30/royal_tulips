<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ou supprimer une chambre</title>
    <!-- Ajoutez votre lien CSS ici -->
</head>
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
    // Vérifier si la clé 'room_id' existe dans le tableau $_POST
    if (isset($_POST['room_id'])) {
        $roomId = $_POST['room_id'];

        // Vérifier si la chambre existe
        $checkSql = "SELECT * FROM rooms WHERE id = $roomId";
        $checkResult = $conn->query($checkSql);

        if ($checkResult) {
            // Vérifier si la chambre existe
            if ($checkResult->num_rows > 0) {
                // Récupérer les détails de la chambre
                $row = $checkResult->fetch_assoc();
                $img = $row['img'];

                $title = $row['title'];
               
                $description = $row['description'];

                // Vérifier l'action à effectuer
                if (isset($_POST['update'])) {
                    // Traitement de la modification
                    $newTitle = $_POST['new_title'];
                    $newDescription = $_POST['new_description'];
                    $newImg = $_POST['new_img'];

                    // Mettre à jour la chambre dans la base de données
                    $updateSql = "UPDATE rooms SET title='$newTitle',img='$newImg', description='$newDescription' WHERE id=$roomId";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "Chambre mise à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour de la chambre : " . $conn->error;
                    }
                } elseif (isset($_POST['delete'])) {
                    // Traitement de la suppression
                    $deleteSql = "DELETE FROM rooms WHERE id=$roomId";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "Chambre supprimée avec succès.";
                    } else {
                        echo "Erreur lors de la suppression de la chambre : " . $conn->error;
                    }
                }
            } else {
                echo "Aucune chambre trouvée avec cet identifiant.";
            }
        } else {
            echo "Erreur lors de la vérification de la chambre : " . $conn->error;
        }
    } else {
        echo "ID de chambre non spécifié.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $newTitle = $_POST['new_title'];
    $newImg = $_POST['new_img'];
    $newDescription = $_POST['new_description'];

    $addSql = "INSERT INTO rooms (title, img, description) VALUES ('$newTitle', '$newImg', '$newDescription')";

    if ($conn->query($addSql) === TRUE) {
        echo "Chambre ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la chambre : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
<!-- Formulaire pour ajouter une nouvelle chambre -->
<form method="post" action="">
    <label for="new_title">Titre :</label>
    <input type="text" name="new_title" required>
    <br>
    <label for="new_img">Image :</label>
    <input type="text" name="new_img" required>
    <br>
    <label for="new_description">Description :</label>
    <textarea name="new_description" required></textarea>
    <br>
    <input type="submit" name="add" value="Ajouter une chambre">
</form>

<h2>Modifier ou supprimer une chambre</h2>

<!-- Formulaire pour saisir l'ID de la chambre -->
<form method="post" action="">
    <label for="room_id">ID de la chambre :</label>
    <input type="text" name="room_id" required>
    <br>
    <input type="submit" name="submit" value="Soumettre">
</form>

<?php
// Afficher le formulaire de modification par défaut
if (isset($title)) {
    ?>
    <br>

    <!-- Afficher le formulaire de modification -->
    <form method="post" action="">
    <!-- Ajoutez un champ caché pour l'ID de la chambre -->
    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
    
    <label for="new_title">Nouveau titre :</label>
    <input type="text" name="new_title" value="<?php echo $title; ?>" required>
    <br>
    <label for="new_img">Nouvelle image :</label>
<input type="text" name="new_img" value="<?php echo $img; ?>" required>

    <label for="new_description">Nouvelle description :</label>
    <textarea name="new_description" required><?php echo $description; ?></textarea>
    <br>
    <input type="submit" name="update" value="Mettre à jour">
</form>

    <br>


  <!-- Afficher le formulaire de suppression -->
<form method="post" action="">
    <!-- Ajoutez un champ caché pour l'ID de la chambre -->
    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
    <input type="submit" name="delete" value="Supprimer la chambre" onclick="return confirm('Voulez-vous vraiment supprimer cette chambre?');">
</form>
    <?php
}
?>

</body>
</html>
