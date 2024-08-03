<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation d'événement</title>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/menu.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>

</head>
<body>

<?php
include 'event_send.php';
// Définir une variable pour stocker le message d'erreur
$error_message = "";
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $nbper = $_POST["nbper"];

    // Connexion à la base de données (remplacez ces valeurs par les vôtres)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_reservation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifie la connexion à la base de données
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  // Check if the email or phone number already exists
  $checkEmailQuery = "SELECT * FROM reservation_event WHERE email = '$email' OR tel = '$tel'";
  $result = $conn->query($checkEmailQuery);
  if ($result->num_rows > 0) {
    $error_message=  "Désolé, l'email ou le numéro de téléphone existe déjà. Veuillez utiliser une adresse email ou un numéro de téléphone différent.";
    
  } 
  else {
    // Insertion des données dans la table reservation_event
    $sql = "INSERT INTO reservation_event (nom, email, tel, nbper) VALUES ('$nom', '$email', '$tel', '$nbper')";

    if ($conn->query($sql) === TRUE) {
       // Envoi de l'email
       include 'event_send.php';
       // Redirection vers une page de confirmation ou autre
       header('Location: confirmationevent.php');
       exit;
    } else {
        echo "Erreur lors de la réservation: " . $conn->error;
    }
  }
  

    // Ferme la connexion à la base de données
    $conn->close();
}
?>

<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;

}


a{
  color: rgb(0, 0, 0);
  text-decoration: none;
}

header{
position: fixed;
background-color:rgb(240, 240, 240);
  color:rgb(205, 144, 1) ;
  z-index: 100000;
  top: 0;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: 0.6s;
}
.main-head.sticky{
background: #fff
}
.main-head.sticky  nav ul li a{
color: #000000;
}
nav{
  min-height: 10vh;
  display: flex;
  align-items: center;
  width: 90%;
  margin: auto;
  padding: 2rem;
}

nav ul{
position: relative;
  display: flex;
  flex: 1 1 40rem;
  justify-content: space-around;
  align-items: center;
  list-style: none;
}
header ul li{
position: relative
;
list-style: none;
}
header ul li a{
position: relative
;
margin: 0 15px;
text-decoration: none;
color: #000000;
letter-spacing: 1px;
font-weight: 500px;
font-size: 1.1rem;
transition: 0.6s;
}

header ul li a:hover{
  color:rgb(205, 144, 1) ;
  text-decoration:underline;

}

#logo{
  flex: 2 1 40rem;

}


.nav .toggle_btn{
color: #010101;
font-size: 1.9rem;
cursor: pointer;
display: none;
}

/***responsive*/

@media  (max-width : 692px){

.nav ul{

  display: none;
}

.nav  .toggle_btn{
  display: block;
}




}


        /*dropdown menu***/
        .dropdown_menu{

          position: absolute;
          right: 2rem;
          top: 60px;
          height: 0;
          width: 300px;
          background: rgba(255, 255, 255, 0.1);
          backdrop-filter: blur(15px);
          border-radius: 10px;
          overflow: hidden;
          transition: height 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
          }
          
          .dropdown_menu.open{
          height: 240px;
          }
          
          .dropdown_menu li{
          
          padding: 0.7rem;
          display: flex;
          align-items: center;
          justify-content: center;
          
          }
          
          .dropdown_menu .action_btn {
          width: 100%;
          display: flex;
          justify-content: center;
          
          
          }
          
          @media  (max-width : 576px){
            .dropdown_menu{
              left: 2rem;
              width: unset;
          
            }}





/*******form */

form {
    
    max-width: 300px;
    margin:  auto;
    margin-top :190px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Add some additional styling for better visual appearance if needed */

form {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

/* Optional: Add media queries for responsiveness */
@media (max-width: 600px) {
    form {
        width: 90%;
    }
}





/*****************Footer*************************/
     
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,500,300,700);




.footer-distributed{
background: #202020
;
box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
box-sizing: border-box;
width: 100%;
text-align: left;
font: bold 16px sans-serif;
padding: 55px 50px;
margin-top: 30px;
border-radius: 50px 0 0 0 ;

}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
display: inline-block;
vertical-align:top;
}

/* Footer left */

.footer-distributed .footer-left{
width: 40%;
}

/* The company logo */

.footer-distributed h3{
color:  #b36c10;
font: normal 36px 'Open Sans', cursive;
margin: 0;
font-weight: bolder;
}

.footer-distributed h3 span{
color:  lightseagreen;
}

/* Footer links */

.footer-distributed .footer-links{
color:  #ffffff;
margin: 20px 0 12px;
padding: 0;
}

.footer-distributed .footer-links a{
display:inline-block;
line-height: 1.8;
font-weight:400;
text-decoration: none;
color:  inherit;
}

.footer-distributed .footer-company-name{
color:  #000000;
font-size: 14px;
font-weight: normal;
margin: 0;
}

/* Footer Center */

.footer-distributed .footer-center{
width: 35%;
}

.footer-distributed .footer-center i{
background-color:  #33383b;
color: #ffffff;
font-size: 25px;
width: 38px;
height: 38px;
border-radius: 50%;
text-align: center;
line-height: 42px;
margin: 10px 15px;
vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope{
font-size: 17px;
line-height: 38px;
}

.footer-distributed .footer-center p{
display: inline-block;
color: #ffffff;
font-weight:400;
vertical-align: middle;
margin:0;
}

.footer-distributed .footer-center p span{
display:block;
font-weight: normal;
font-size:14px;
line-height:2;
}

.footer-distributed .footer-center p a{
color:  lightseagreen;
text-decoration: none;;
}

.footer-distributed .footer-links a:before {
content: "|";
font-weight:300;
font-size: 20px;
left: 0;
color: #fff;
display: inline-block;
padding-right: 5px;
}

.footer-distributed .footer-links .link-1:before {
content: none;
}

/* Footer Right */

.footer-distributed .footer-right{
width: 20%;
}

.footer-distributed .footer-company-about{
line-height: 20px;
color:  #92999f;
font-size: 13px;
font-weight: normal;
margin: 0;
}

.footer-distributed .footer-company-about span{
display: block;
color:  #ffffff;
font-size: 14px;
font-weight: bold;
margin-bottom: 20px;
}

.footer-distributed .footer-icons{
margin-top: 25px;
}

.footer-distributed .footer-icons a{
display: inline-block;
width: 35px;
height: 35px;
cursor: pointer;
background-color:  #33383b;
border-radius: 2px;

font-size: 20px;
color: #ffffff;
text-align: center;
line-height: 35px;

margin-right: 3px;
margin-bottom: 5px;
}

/* If you don't want the footer to be responsive, remove these media queries */

@media (max-width: 880px) {

.footer-distributed{
font: bold 14px sans-serif;
}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
display: block;
width: 100%;
margin-bottom: 40px;
text-align: center;
}

.footer-distributed .footer-center i{
margin-left: 0;
}

}

</style>
<header class="main-head">
      
      <nav class="nav">  <h1 id="logo">Royal Tulip</h1>
          <ul>
              <li><a href="../event_room/hotel.php">Home </a></li>
              <li><a href="../event_room/hotel.php#about">About</a></li>
                <li><a href="../event_room/hotel.php#rooms">Rooms</a></li>
                <li><a href="../event_room/hotel.php#events">Event</a></li>
                <li><a href="../event_room/hotel.php#contact">Contact</a></li>
              <li><a href="../form_reservation/formulaire.html">Reservation</a></li>
             
          </ul>
          
         
          <div class="toggle_btn">

              <i class="fa-solid fa-bars"></i>
                </div>
                </nav>



            
  <div class="dropdown_menu">
      <li><a href="../event_room/hotel.php">Home </a></li>
      <li><a href="../event_room/hotel.php#about">About</a></li>
                <li><a href="../event_room/hotel.php#rooms">Rooms</a></li>
                <li><a href="../event_room/hotel.php#events">Event</a></li>
                <li><a href="../event_room/hotel.php#contact">Contact</a></li>
          <li><a href="../form_reservation/formulaire.html">Reservation</a></li>
    </div>
  </header>
  <script>
      const togglebtn=document.querySelector('.toggle_btn');
      const togglebtnicon =document.querySelector('.toggle_btn i');
      const dropDownMenu=document.querySelector('.dropdown_menu');
  
      togglebtn.onclick = function(){
        dropDownMenu.classList.toggle('open');
        const isOpen = dropDownMenu.classList.contains('open')
  
        togglebtnicon.classList =isOpen 
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
      }
  
      
    </script>



<form action="" method="POST">
<h2>reservation events</h2>
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>
<br>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>
<br>
    <label for="tel">Téléphone :</label>
    <input type="text" name="tel" id="tel" required>
<br>
    <label for="nbper">Nombre de personnes :</label>
    <input type="number" name="nbper" id="nbper"  min="1" required>
<br>
    <button name="send" type="submit">Réserver</button>
    <?php if (!empty($error_message)) { ?>
    <p><?php echo $error_message; ?></p>
<?php } ?>
  
</form>
<footer class="footer-distributed">

    <div class="footer-left">

      <h3>Royal Tulip</h3>

      <p class="footer-links">
        <a href="#" class="link-1">Home</a>
        
        <a href="#">Reservation</a>
      
        <a href="#">contact </a>
      
        <a href="#">About</a>
        
        
      </p>

      <p class="footer-company-name">Royal Tulip  © 2015</p>
    </div>

    <div class="footer-center">

      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Ain oktor, Korbous 8041 </span> </p>
      </div>

      <div>
        <i class="fa fa-phone"></i>
        <p>36028000</p>
      </div>

      <div>
        <i class="fa fa-external-link"></i>
        <p><a href="https://royal-tulip-korbous.goldentulip.com/en-us/">goldentulip.com</a></p>
      </div>

    </div>

    <div class="footer-right">

      <p class="footer-company-about">
        <span>About </span>
        Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
      </p>

      <div class="footer-icons">

        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>

      </div>

    </div>

  </footer>

</body>
</html>
