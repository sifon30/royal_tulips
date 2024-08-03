<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Tulip</title>
    <link rel="stylesheet" href="hotel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/menu.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        window.addEventListener("scroll",function(){
          var header =document.querySelector("header");
          header.classList.toggle("sticky",window.scrollY>0);
        })

/*********room****************/

      document.addEventListener('DOMContentLoaded', function () {
          const scrollContainer = document.querySelector('.scroll-container');
          const roomList = document.querySelector('.room-list');
          const roomItems = document.querySelectorAll('.room-item');
          const arrowLeft = document.querySelector('.arrow.left');
          const arrowRight = document.querySelector('.arrow.right');
      
          let currentIndex = 0;
          let visibleRooms = 3;
          let totalRooms = roomItems.length;
      
          arrowLeft.addEventListener('click', function () {
              if (currentIndex > 0) {
                  currentIndex--;
              } else {
                  currentIndex = totalRooms - visibleRooms;
              }
              updateScroll();
          });
      
          arrowRight.addEventListener('click', function () {
              if (currentIndex < totalRooms - visibleRooms) {
                  currentIndex++;
              } else {
                  currentIndex = 0;
              }
              updateScroll();
          });
      
          function updateScroll() {
              const itemWidth = roomItems[0].offsetWidth;
              const newPosition = -currentIndex * itemWidth;
              roomList.style.transform = `translateX(${newPosition}px)`;
          }
      });
      </script>
      <script>
         function validateForm() {
        var nameInput = document.getElementById('nameInput');
        var emailInput = document.getElementById('emailInput');
        var phoneInput = document.getElementById('phoneInput');
        var messageInput = document.getElementById('messageInput');
    
        // Vérifier si les champs sont vides
        if (nameInput.value.trim() === '' || emailInput.value.trim() === '' || phoneInput.value.trim() === '' || messageInput.value.trim() === '') {
            alert('Veuillez remplir tous les champs du formulaire.');
            return;
        }
    
        // Ajoutez d'autres validations si nécessaire, par exemple pour l'email ou le numéro de téléphone
    
        // Si toutes les validations passent, vous pouvez envoyer le formulaire ici
        alert('Formulaire validé et prêt à être envoyé!');
    }
      </script>
      
</head>
<body>
   

    


    <header class="main-head">
      
        <nav class="nav">  <h1 id="logo">Royal Tulip</h1>
            <ul>
                <li><a href="hotel.php">Home </a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#rooms">Rooms</a></li>
                <li><a href="#events">Event</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="../form_reservation/formulaire.html">Reservation</a></li>
               
            </ul>
            
           
            <div class="toggle_btn">
  
                <i class="fa-solid fa-bars"></i>
                  </div>
                  </nav>



              
    <div class="dropdown_menu">
        <li><a href="hotel.php">Home </a></li>
            <li><a href="#about"> About </a></li>
            <li><a href="#rooms"> Rooms</a></li>
            <li><a href="#events">Event</a></li>

            <li><a href="#contact">Contact</a></li>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var div1 = document.querySelector('.div1');

    // Function to add 'show' class to the div for animation
    function showDiv() {
        div1.classList.add('show');
    }

    // Delay the animation for 500 milliseconds (adjust as needed)
    setTimeout(showDiv, 500);
});

</script>
  

    <div class="div1" >
        <div class="title">
        <h1>Welcome to Royal Tulip
            <br>Make your hotel reservation</h1>

        
        
    </div>
</div>



<div  id="about"class="row1">
    <div class="col2">
      <h3>About</h3>
      <p>This magnificient 5-Stars hotel is the first resort of Royal Tulip in Tunisia is situated between the gulf of Tunis and Korbus Mountain, 
        offering luxury services to its guests.They will be delighted with the sophistication of its unique wellness center and its several choice 
        of bars and gastronomic restaurants.</p>
        <button class="button" type="button"><a href="#contact" >Contact Us </a></button>
  
    </div>
    <div class="col2">
        <video class="aaa" autoplay loop muted controls>
            <source src="vhhotel.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
  
    </div>
   </div> 



   


 <!-- our_room -->
 





<div id="rooms" class="our_room">
<div class="roomtitle">
    <h3>Our Rooms</h3>
</div>

<div class="scroll-container">
    <div class="room-list">
<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        $result_rooms = $conn->query("SELECT * FROM rooms");

while ($row = $result_rooms->fetch_assoc()) {
    echo '<div class="room-item">';
    echo '<img src="../room/' . $row['img'] . '" alt="">';
    echo '<div class="desc">';
    echo '<h3>' . $row['title'] . '</h3>';
    echo '<p>' . $row['description'] . '</p>';
    echo '</div></div>';
}

?>

        

    </div>
</div>

<div class="nav-arrows">
    <div class="arrow left">&#8249;</div>
    <div class="arrow right">&#8250;</div>
</div>
</div>


 



<!--***********************Event****************-->
<section class="sectionEv" id="events">

    <h2 class="titleEvent">Our Events</h2>
    <div class="hotel-events">
      <?php
    $result_events = $conn->query("SELECT * FROM events");

while ($row = $result_events->fetch_assoc()) {
    echo '<div class="event">';
    echo '<img src="../event/' . $row['img'] . '" alt="' . $row['title'] . ' Image">';
    echo '<div class="event-details">';
    echo '<h3>' . $row['title'] . '</h3>';
    echo '<p>Availability: ' . $row['availability'] . '</p>';
    echo '<p>Status: ' . $row['status'] . '</p>';
    echo '<p>Date: ' . $row['date'] . '</p>';
 // Vérifier si l'availability est supérieure à zéro avant d'afficher le bouton
 if ($row['availability'] <> "completed") {
    echo '<button class="reserve-event-btn"><a href="../event/reservation_event.php" >Reserve Now</a></button>';
}

echo '</div></div>';
}
 


 





// Fermeture de la connexion
$conn->close();
?>
       
      
    
      
      
    </div>
  </section>
    
    
  

<!--*************contact*************************************************-->
    


<div id="contact" class="contact">

    <div class="titre">
        <h3>Contact</h3>
    </div>


    <div class="row">
        <div class="col-md-6">
            <form id="request" class="main_form" action="../form_contact/contact.php" method="POST">
                <div class="row8">
                    <div class="col-md-12 ">
                        <input class="contactus" placeholder="Name" type="type" name="Name" id="nameInput"> 
                    </div>
                    <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="type" name="Email" id="emailInput"> 
                    </div>
                    <div class="col-md-12">
                        <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number" id="phoneInput">                          
                    </div>
                    <div class="col-md-12">
                        <textarea class="textarea" placeholder="Message" type="type" name="Message" id="messageInput"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button class="send_btn" name="send" onclick="validateForm()">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="map_main">
                <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d104184.26052189653!2d10.563984546895494!3d36.77973013686574!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd554aaf58fd11%3A0x355cdfe2ead85624!2sROYAL%20TULIP%20KORBOUS%20BAY!5e0!3m2!1sfr!2stn!4v1706017192047!5m2!1sfr!2stn" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
    




<!--********************************************footer********************************-->

<footer class="footer-distributed">

    <div class="footer-left">

      <h3>Royal Tulip</h3>

      <p class="footer-links">
        <a href="#" class="link-1">Home</a>
        <a href="#about">About</a>
       <a href="#contact">contact </a>
      
         <a href="../form_reservation/formulaire.html">Reservation</a>
      
        
        
        
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
        This magnificient 5-Stars hotel is the first resort of Royal Tulip in Tunisia is situated between the gulf of Tunis and Korbus Mountain, 
        offering luxury services to its guests.
      </p>

      <div class="footer-icons">

        <a href="https://www.facebook.com/Royal.Tulip.Korbous.Bay"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/goldentuliphotels/?hl=fr"><i class="fa fa-instagram"></i></a>

      </div>

    </div>

  </footer>


</body>
</html>