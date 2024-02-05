<?php
/*Tableau de "correspondances" contenant les correspondances entre les notes classiques françaises 
et les notes américaines*/
$correspondances = [
    "do" => "C",
    "ré" => "D",
    "mi" => "E",
    "fa" => "F",
    "sol" => "G",
    "la" => "A",
    "si" => "B"
];
  
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['selectedNote'])){
        $selectedNote = $_POST['selectedNote'];
        $correspondanceAmericaine = '';
        //
        if(isset($correspondances[$selectedNote])){
            $correspondanceAmericaine = $correspondances[$selectedNote];
            $message = 'La notation américaine pour la note ' .$selectedNote.' est '. $correspondanceAmericaine;
        } 
        echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    } 
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

<!--Fichier script-->
<script src="script.js"></script> 
</body>
</html>