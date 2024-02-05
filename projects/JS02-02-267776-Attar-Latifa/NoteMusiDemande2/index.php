<?php
$notes = ["do" => "C", "ré" => "D", "mi" => "E", "fa" => "F", "sol" => "G", "la" => "A", "si" => "B"];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['note_classique'])){
        if(empty($_POST['note_classique'])){
            //Si le champ vide est sélectionnée 
        // Construire le message si le champ vide sélectionné
        $message = 'Pas de choix fait, veuillez choisir une note';   
        }else{
            $note = $_POST['note_classique'];
            $correspondanceAmericaine = $notes[$note];
            $message = 'La notation américaine pour la note ' .$note.' est '. $correspondanceAmericaine;
        }           
    }
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo $message;
exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<!--IE navigateur-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!--responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--CDN Bootstrap.css-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="style.css">


<!-- Attar Latifa  20/10/2023 Devoir. Se perfectionner en JavaScript
     Note de musique tout en unobstrusive Javascript Demande-2 -->

<title>Note de musique tout en unobstrusive Javascript</title> 
</head>

<body>
<div id="background"></div>
<div>
    <h1 class="heading fig p-3 mb-5 mx-auto">Note de musique</h1>
</div>
<div class="container pt-5 pr-5 pb-4 pl-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
           <!--Formulaire-->
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9 text-center">
           <button id="boutonNotation" class="button py-2 px-4">Notation</button>
        </div>
    </div>
</div>
<!--Fichier script-->
<script src="script.js"></script> 
</body>
</html>