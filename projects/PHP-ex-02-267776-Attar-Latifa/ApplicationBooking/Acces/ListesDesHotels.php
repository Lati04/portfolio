<?php
require_once ('../Database.php');
require_once ('../Class/Class.php');
require_once ('../Class/ClassManager.php');
require_once ('../config_menu.php');
$database = new Database();
$dbh = $database->getConnection();

////////////////////////////////////////////////////////////
//////                      HOTEL                     //////
///////////////////////////////////////////////////////////
// Instanciation de la classe HotellManager
$hotelManager = new HotelManager($dbh);
// Appel de la méthode getData
$hotels = $hotelManager-> getData('hotel');

////////////////////////////////////////////////////////////
///////                   ROOMS                     ////////
///////////////////////////////////////////////////////////
//$rooms = new Rooms($room);
// Instanciation de la classe RoomlManager
$roomsManager = new RoomsManager($dbh);
// Appel de la méthode getData
$roomsData = $roomsManager-> getData('rooms');

////////////////////////////////////////////////////////////
///////                 BOOKING                    /////////
///////////////////////////////////////////////////////////
// Instanciation de la classe BookingManager
$bookingManager = new BookingManager($dbh);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<!--IE navigateur-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!--responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--CDN Bootstrap.css-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="../css/style.css">
    
<!-- Attar Latifa  01/10/2023 PHP expert - Devoir n°2 : Application booking-->
      
<title>Listes des hotels</title>
       
</head>
<body class="body">
<!--Appel menu-->
<?php
generateMenu('ListesDesHotels.php', '', './Acces/Reservations.php');
?>  

<div>
    <h1 class="heading fig p-3 m-4">Listes des hotels</h1>
</div>

<div class = "container my-5">
    <div class="row">
    <!-- Container contenant la liste des hotels présentée sous forme de card affichés via la boucle foreach.
     Dans chaque card, nous avons le nom et l'adresse de l'hotel, des champs permettant de selectionner les 
     dates de début et fin de réservation. Si une chambre est disponible et attribué, alors seulement le client 
     aura la possibilité d'accéder à la page Reservation.php via le bouton Réserver. -->
    <?php
    if(!is_null($hotels)){
        foreach($hotels as $hotelData){
            $hotel = new Hotel($hotelData);
            echo'<div class="col-md-6 p-3">';
                echo'<div class="card mb-3" style="width:36rem;">';
                echo'<div class="card-body text-center">';
                    echo'<h5 class="card-title">' . $hotel->getName() . '</h5>';
                    echo'<p class="card-text">' . $hotel->getAdress() . '</p>';
                echo'</div>';
                echo'<div class="card-body text-center">';
                // Entrer les dates de début et de fin de réservation
                echo'<form action="ListesDesHotels.php" method="POST">';
                echo'<input type="hidden" name="hotelId" value='. $hotel->getId() .'>';

                $dt_deb_reservation = isset($_POST['dt_deb_reservation_' . $hotel->getId()]) 
                ? $_POST['dt_deb_reservation_' . $hotel->getId()] : '';
                $dt_fin_reservation = isset($_POST['dt_fin_reservation_' . $hotel->getId()]) 
                ? $_POST['dt_fin_reservation_' . $hotel->getId()] : '';

                    echo'<div class="row">';
                        echo'<div class="col-md-6">';
                        echo'<label for="dt_deb_reservation_' . $hotel->getId() .'" class="size">Date de début de réservation:</label>';
                        echo'<input class="p-2" type="date" id="dt_deb_reservation_' . $hotel->getId() .'" name="dt_deb_reservation_' 
                        . $hotel->getId() .'" value="' . $dt_deb_reservation . '">';
                        echo'</div>';
                       
                       
                        echo'<div class="col-md-6">';
                        echo'<label for="dt_fin_reservation_' . $hotel->getId() .'" class="size">Date de fin de réservation:</label>';
                        echo'<input class="p-2" type="date" id="dt_fin_reservation_' . $hotel->getId() .'" name="dt_fin_reservation_' 
                        . $hotel->getId() .'"value="' . $dt_fin_reservation . '">';
                        echo'</div>';
                    echo'</div>';
                    echo'<br><br>';

                    // Vérifier la disponibilté d'une chambre selon les dates de réservation 
                    echo'<input type="submit" name="check_disponibilité_' . $hotel->getId() .
                    '" value="Vérifier Disponibilité" class="mb-2 p-2" style="font-weight:bold">';
                    echo'</form>';   

                    // initialisation $roomAvailable
                    $roomAvailable = null;
                    if(isset($_POST['check_disponibilité_' . $hotel->getId()])){
                        $dt_deb_reservation_hotel = $_POST['dt_deb_reservation_' . $hotel->getId()];
                        $dt_fin_reservation_hotel = $_POST['dt_fin_reservation_' . $hotel->getId()];

                            if(!empty($dt_deb_reservation_hotel) && !empty($dt_fin_reservation_hotel)){
                            // Appel de la méthode getFirstAvailableRoom
                            $roomAvailable = $bookingManager-> getFirstAvailableRoom($dt_deb_reservation_hotel,
                            $dt_fin_reservation_hotel, $hotel->getId());
                                 
                            // Vérifier si une chambre est disponible
                            if($roomAvailable != null){
                                $room = new Rooms($roomAvailable);
                                $roomId = $roomAvailable['id'];
                                echo'<p>Première chambre disponible: ' .$room->getNumberRooms() . '</p>';   
                            }else{
                                echo'<p>Aucune chambre disponible à cette période. Veuillez changer les dates de réservation.</p>';
                            }
                            }else{
                                echo'<p>Veuillez entrer vos dates de réservations avant de vérifier la disponibilité.</p>';
                            }
                            if($roomAvailable){
                                $hotelId = $hotel->getId();
                                $roomNumber = $room->getNumberRooms();
                                $roomId = $roomAvailable['id'];
                            
                                // Une chambre a été attribuée, afficher le bouton de réservation
                                echo'<a href="Reservations.php?hotelId=' . $hotelId . '&roomId='. $roomAvailable['id'] .
                                    '&roomNumber='. $roomNumber .
                                    '&dtDeb='. $dt_deb_reservation_hotel . 
                                    '&dtFin='. $dt_fin_reservation_hotel .'">';
                                echo'<button type="button" class="btn btn-success py-2 px-3" style="width:18rem; 
                                font-size:18px;">Réserver</button>';
                                /*Les données dt_deb_reservation, dt_fin_reservation, numéro de chambre attribué,
                                ainsi que ceux de l'hotel sans stockées dans l'URL afin de les récuperer dans la
                                page Reservation.php*/
                                echo'</a>';
                            }
                    } 
                echo'</div>';
                echo'</div>';
                echo'<div class="divider"></div>';
            echo'</div>';
        echo'<br>';
        }
    }  
    ?>
    </div>
</div>
</body>
</html>