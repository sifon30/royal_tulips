<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumModifier un événementent</title>
</head>
<style> body {
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

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="date"] {
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        /* Optional: Add some additional styling for better visual appearance if needed */
        form {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }</style>
<body>

<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn= new mysqli($servername,$username,$password,$dbname);

if($conn ->connect_error){
    die("la connexion a échoué : " .$conn->connect_error);
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['event_id'])){
        $eventId = $_POST['event_id'];

        $checksql = "SELECT * FROM events WHERE id = $eventId";
        $checkResult=$conn->query($checksql);

        if($checkResult){
            if($checkResult->num_rows > 0){
                $row = $checkResult->fetch_assoc();

                $eventName = $row['title'];
                $eventimg = $row['img'];
                $eventAvailability = $row['availability'];
                $eventStatus = $row['status'];
                $eventDate = $row['date'];

                if(isset ($_POST['update'])){
                    $newEventName = $_POST['new_event_name'];
                    $newEventImg =$_POST['new_event_img'];
                    $newEventAvailability = $_POST['new_event_availability'];
                    $newEventStatus = $_POST['new_event_status'];
                    $newEventDate = $_POST['new_event_date'];


                    $updateSql =" UPDATE events SET img ='$newEventImg', title= '$newEventName', availability='$newEventAvailability', status='$newEventStatus', date='$newEventDate' WHERE id=$eventId";
                    if($conn -> query($updateSql)===TRUE){
                        echo  "Événement mis à jour avec succès.";
                    }
                    else{
                        echo "Erreur lors de la mise à jour de l'événement : " . $conn->error;
                    }
                }

            }
            else {
                echo "Aucun événement trouvé avec cet identifiant.";
            }
        }else {
            echo "Erreur lors de la vérification de l'événement : " . $conn->error;
        }
    }
    else {
        echo "ID d'événement non spécifié.";
    }
}
$conn->close();
?>
<h2>Modifier un événement</h2>

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

        <label for="new_event_img">Nouveau image d'événement :</label>
        <input type="text" name="new_event_img" value="<?php echo $eventimg; ?>" required>
        <br>
        
        <label for="new_event_name">Nouveau nom d'événement :</label>
        <input type="text" name="new_event_name" value="<?php echo $eventName; ?>" required>
        <br>
        <label for="new_event_availability">Nouvelle disponibilité :</label>
        <input type="text" name="new_event_availability" value="<?php echo $eventAvailability; ?>" required>
        <br>
        <label for="new_event_status">Nouveau statut :</label>
        <input type="text" name="new_event_status" value="<?php echo $eventStatus; ?>" required>
        <br>
        <label for="new_event_date">Nouvelle date :</label>
        <input type="date" name="new_event_date" value="<?php echo $eventDate; ?>" required>
        <br>
        <input type="submit" name="update" value="Mettre à jour">
    </form>


    <br>
    <?php
}
?>
</body>
</html>