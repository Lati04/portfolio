<?php
require_once ('Database.php');
$database = new Database();
$dbh = $database->getConnection();

//Affichage menu 
$menuItems = [
    ['text' => 'Accueil', 'url' => '../index.php'],
    ['text' => 'Listes des hotels', 'url' => './Acces/ListesDesHotels.php'],
    ['text' => 'Réservations', 'url' => './Acces/Reservations.php']
];

// Méthode permettant d'afficher le menu sur chacune des pages, 
function generateMenu($currentPage, $returnPage ='', $deactivatedPage = ''){
    global $menuItems;
    echo'<ul>';
    foreach($menuItems as $menuItem){
        $url = $menuItem['url'];
        $text = $menuItem['text'];

        // Vérifier si la page en cours est la page actuelle
        if($url == $currentPage){
            echo'<li class="active">' . $text . '</li>';

        // Permettra de désactiver la page réservation, accessible qu'une fois la chambre attribué et clic reserver
        }elseif ($url == $deactivatedPage){
            echo'<li class="disabled">'.$text .'</li>';

        // Permettra un retour éventuel à la page listesDesHotels si le client le souhaite, car chemin différent
        }elseif($returnPage !== ''){
            echo'<li><a href="' .$returnPage . '">' .$text .'</a></li>';
        }
        else{
            echo'<li><a href="' .$url . '">' .$text .'</a></li>';
        }
    }
    echo'</ul>';
}
?>

