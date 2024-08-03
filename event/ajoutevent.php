<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
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

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        form {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    $newEventName = $_POST['new_event_name'];
    $newEventAvailability = $_POST['new_event_availability'];
    $newEventStatus = $_POST['new_event_status'];
    $newEventDate = $_POST['new_event_date'];

    // Check if a file is uploaded
    if (isset($_FILES['new_event_img']) && $_FILES['new_event_img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "images/";
        $uploadFile = $uploadDir . basename($_FILES['new_event_img']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['new_event_img']['tmp_name'], $uploadFile)) {
            $newEventImg = $uploadFile;

            // Insert data into the database
            $addSql = "INSERT INTO events (img, title, availability, status, date) VALUES ('$newEventImg', '$newEventName', '$newEventAvailability', '$newEventStatus', '$newEventDate')";

            if ($conn->query($addSql) === TRUE) {
                echo "<p style='text-align: center; color: #3498db;'>Événement ajouté avec succès.</p>";
            } else {
                echo "<p style='text-align: center; color: #f44336;'>Erreur lors de l'ajout de l'événement : " . $conn->error . "</p>";
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

<!-- Formulaire pour ajouter un événement -->
<h2>Ajouter un événement</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="new_event_name">Titre :</label>
    <input type="text" name="new_event_name" required>
    <br>
    <label for="new_event_img">Image :</label>
    <input type="file" name="new_event_img" accept="image/*" required>
    <br>
    <label for="new_event_availability">Availability :</label>
    <select name="new_event_availability" required>
        <option value=""></option>
        <option value="completed">Completed</option>
        <option value="limited">Limited</option>
    </select>
    <br>
    <label for="new_event_status">Status :</label>
    <input type="text" name="new_event_status" required>
    <br>
    <label for="new_event_date">Date :</label>
    <input type="date" name="new_event_date" required>
    <br>
    <input type="submit" name="add" value="Ajouter un événement">
</form>
</body>
</html>
