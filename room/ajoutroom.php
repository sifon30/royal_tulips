<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une chambre</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $newTitle = $_POST['new_title'];
    $newDescription = $_POST['new_description'];

    if (isset($_FILES['new_img']) && $_FILES['new_img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "images/";
        $uploadFile = $uploadDir . basename($_FILES['new_img']['name']);

        if (move_uploaded_file($_FILES['new_img']['tmp_name'], $uploadFile)) {
            $newImg = $uploadFile;
            $addSql = "INSERT INTO rooms (title, img, description) VALUES ('$newTitle', '$newImg', '$newDescription')";

            if ($conn->query($addSql) === TRUE) {
                echo "<p style='text-align: center; color: #4caf50;'>Chambre ajoutée avec succès.</p>";
            } else {
                echo "<p style='text-align: center; color: #f44336;'>Erreur lors de l'ajout de la chambre : " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='text-align: center; color: #f44336;'>Erreur lors du téléchargement du fichier.</p>";
        }
    } else {
        echo "<p style='text-align: center; color: #f44336;'>Veuillez sélectionner une image.</p>";
    }
}

$conn->close();
?>

<h2>Ajouter une chambre</h2>
<form method="post" action="" enctype="multipart/form-data">
    <label for="new_title">Titre :</label>
    <input type="text" name="new_title" required>
    <br>
    <label for="new_img">Image :</label>
    <input type="file" name="new_img" accept="image/*" required>
    <br>
    <label for="new_description">Description :</label>
    <textarea name="new_description" required></textarea>
    <br>
    <input type="submit" name="add" value="Ajouter une chambre">
</form>
</body>
</html>
