<?php
require_once ('../Database.php');
require_once ('../Class/Class.php');
require_once ('../Class/ClassManager.php');
require_once ('../config_menu.php');
$database = new Database();
$dbh = $database->getConnection();
///////////////////////////////////////////////////////////////////////////////////////
////////                                    BOOKING                            ////////
////Récupération des détails des dates de réservation, de l'hotel, et de la chambre////
///////////////////////////////////////////////////////////////////////////////////////

$roomId = isset($_GET['roomId']) ? $_GET['roomId']:'';
$dtDeb = isset($_GET['dtDeb']) ? $_GET['dtDeb']:'';
$dtFin = isset($_GET['dtFin']) ? $_GET['dtFin']:'';
$hotelId = isset($_GET['hotelId']) ? $_GET['hotelId']: '';
$roomNumber = isset($_GET['roomNumber']) ? $_GET['roomNumber']: '';

//////////////////////// Instanciation de la classe BookingManager/////////////////////
$bookingManager = new BookingManager($dbh);
///Récuperer les détails de l'hotel en utilisant l'ID de l'HOTEL
$hotelData = $bookingManager->getDataBy('hotel', 'id', $hotelId);
$hotelName = '';
if(isset($hotelData['name'])){
    $hotelName = $hotelData['name'];
}
///Récuperer les détails de la chambre en utilisant le numéro de chambre
$roomData = $bookingManager->getDataBy('rooms', 'number_rooms', $roomNumber);

////////////////////////// Instanciation de la classe RoomlManager////////////////////
$roomsManager = new RoomsManager($dbh);
if(!empty($roomId)){
  ///Récuperer les détails de la room en utilisant l'ID de la room
$roomData = $roomsManager->getDataBy('rooms', 'id', $roomId);
}

/////////////////////////////////////////////////////////////////////////////////////
////////                              FORMULAIRE                             ////////
/////////////////////////////////////////////////////////////////////////////////////
// initialisation des données à valeur vide.
$name = $email = $agree ="";

// initialisation des données erronées à valeur vide.
$nameError = $emailError = $agreeError ="";
 
/* Utilisation de la super global $_SERVER avec la propriétée request_method égale à 
POST pour récuperer les informations données par l'utilisateur après l'envoi du formulaire.*/
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $name = isset($_POST['name']) ? verifyInput($_POST['name']): '';
    $email = isset($_POST['email']) ? verifyInput($_POST['email']): '';
    $hotelId = isset($_POST['hotelId']) ? verifyInput($_POST['hotelId']): '';
    $roomId = isset($_POST['roomId']) ? verifyInput($_POST['roomId']): '';
    $roomNumber = isset($_POST['roomNumber']) ? verifyInput($_POST['roomNumber']): '';
    $dtDeb = isset($_POST['dtDeb']) ? verifyInput($_POST['dtDeb']): '';
    $dtFin = isset($_POST['dtFin']) ? verifyInput($_POST['dtFin']): '';
    $hotelName = isset($_POST['hotelName']) ? verifyInput($_POST['hotelName']): '';
    
    $confirmMessage = "Mr/Mme $name, votre réservation du $dtDeb au $dtFin à l'hotel $hotelName a été 
    enregistrée avec succès.";
   
 // Vérification coté serveur -validation des données du formulaire. 
 
    if(empty($name)){ // Condition: si $name est vide, afficher $nameError
       $nameError = "Veuillez fournir votre nom s'il vous plait !"; 
    } 

    if(empty($email)){ // Condition: si $email est vide, afficher $emailError
       $emailError = "Veuillez fournir votre adresse mail s'il vous plait!";

    } elseif(!isEmail($email)){// condition :si ce n'est pas un mail valide, $emailError affiché
        $emailError = "Veuillez entrer un email valide s'il vous plait !"; 
    } 

    if(!isset($agree)){ // Condition: si $email est vide, afficher $emailError
        $agreeError = "Veuillez cocher cette case s'il vous plait!"; 
    }

    if(empty($nameError) && empty($emailError)){
                ////////////////////////////////////////////////////////////// 
                ////////                   BOOKING                   /////////
                //////////////////////////////////////////////////////////////
                    // Format: date("Y-m-d");
                    $dt_creation = date("Y-m-d");
                    // Création d'un objet booking
                    $data_booking = [
                        'id' => null,
                        'dt_deb_reservation' => $dtDeb,
                        'dt_fin_reservation' => $dtFin,
                        'dt_creation' => $dt_creation,
                        'id_room' => (int)$roomId
                    ];
                    $booking = new Booking($data_booking);
                    // Instanciation de la classe bookingManager
                    $bookingManager = new BookingManager($dbh);
                    // Appel de la méthode addData
                    $bookingManager-> addData('booking', $data_booking);
                    $bookingId = $bookingManager->getLastInsertedId();
                
                //////////////////////////////////////////////////////////////
                ////////                    CLIENT                    ////////
                //////////////////////////////////////////////////////////////
                    // Création d'un objet client
                    $client_data = [
                        'id' => null,
                        'name' => $name,
                        'email'=> $email,
                        'id_booking' => $bookingId
                    ];
                    $client = new Client($client_data);
                    // Instanciation de la classe clientManager
                    $clientManager = new ClientManager($dbh);
                    // Appel de la méthode addData
                    $clientManager-> addData('client', $client_data);     

      // Vérifier si les insertions ont réussi dans les deux tables
      if($bookingId > 0){
        // Affiche le message de confirmation
        echo'<p class="confirmMessage"> '.$confirmMessage .'</p>';
        }                
    } 
}

// permet de vérifier si le mail est valide
function isEmail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL) !== false; 
} 

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////                              SECURITE                                         /////////
//////////////////////////////////////////////////////////////////////////////////////////////////
// fonction verifyInput avec une variable $var permettant de vérifier tous les input.
function verifyInput($var){
    $var = trim($var); // retrait des espaces, tab, aller à la ligne, ...des champs du formulaire
    $var = stripslashes($var); // retrait des antislashs
    $var = htmlspecialchars($var); //éviter l'insertion de code HTML nuisibles 
    return $var; //après l'application de chacun des traitements sur $var
}
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
      
<title>Réservations</title>
       
<!--balise php + echo avec la super global $_SERVER [PHP_SELF] permettant de renvoyer vers la méme adresse de la 
   page initiale-->
 
</head>
<body>
<!--Appel menu-->
<?php
generateMenu('Reservations.php', 'ListesDesHotels.php', '');
?> 
<div>
    <h1 class="heading fig p-3 m-4">Réservations</h1>
</div>
<div class = "container my-5 p-5">   
    <!--Formulaire permettant d'inserer les données dans la table client et booking -->
    <form id="contact-form" class="row g-4 p-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="col-md-6">
             <label for="name" class="form-label">Nom<span class="red">*</span></label>
             <input type="text" class="form-control" id="name" name="name" value="<?php echo$name; ?>">
             <p class="comments"><?php echo $nameError; ?></p>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email<span class="red">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo$email; ?>">
            <p class="comments"><?php echo $emailError; ?></p>
        </div>

        <div class="col-md-4">
            <label for="hotelName" class="form-label">Hotel</label>
            <input type="text" class="form-control" id="hotelName" name="hotelName" value="<?php echo $hotelName; ?>">
        </div>

        <input type= "hidden" name="roomId" value="<?= $roomId ?>">

        <div class="col-md-4">
            <label for="roomAvailable" class="form-label">Chambre attribuée</label>
            <input type="text" class="form-control" id="roomAvailable" name="roomNumber"
                    value="<?php echo $roomNumber ?>">
        </div>
        
        <div class="col-md-2">
            <label for="dtDeb" class="form-label">Début de réservation</label>
            <input type="text" class="form-control" id="dtDeb" name="dtDeb"
                    value="<?php echo $dtDeb; ?>">
        </div>
        
        <div class="col-md-2">
            <label for="dtFin" class="form-label">Fin de réservation</label>
            <input type="text" class="form-control" id="dtFin" name="dtFin"
                    value="<?php echo $dtFin; ?>">
        </div>

        <div class="col-md-12">
             <p class="comments"><strong>* Ces informations sont requises</strong></p>
        </div>

        <div class="col-12">
            <div class="form-check">
            <label class="form-check-label" for="invalidCheck2">
                <p class="comments">Accepter les termes et conditions</p>
            </label>
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" name="agree">
            <p class="comments"><?php echo $agreeError; ?></p>
            </div>
        </div>
        
        <div class="col-12 text-center">
            <button class="btn btn-success" style="width:18rem; font-size:20px" type="submit">Réserver</button>
        </div>
        </form>
        <br>
    </div>
</body>
</html>