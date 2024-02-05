<?php
require_once('./API/db_config.php');
require_once('./API/api_functions.php');

// Connexion à la base de données en PDO
$db = new DB_config();
$pdo = $db->getConnection();

// Créer une instance de la classe API_Functions avec la connexion à la base de données
$api = new API_Functions($pdo);


// initialisation des données à valeur vide.
$name = $pays = $difficulte = $detail  = $id = "";

/* Utilisation de la super global $_SERVER avec la propriétée request_method égale à 
GET pour récuperer les informations données par l'utilisateur après l'envoi du formulaire.*/
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = isset($_GET['id']) ? verifyInput($_GET['id']): '';
}

/* Utilisation de la super global $_SERVER avec la propriétée request_method égale à 
POST pour récuperer les informations données par l'utilisateur après l'envoi du formulaire.*/
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $name = isset($_POST['name']) ? verifyInput($_POST['name']): '';
    $pays = isset($_POST['pays']) ? verifyInput($_POST['pays']): '';
    $difficulte= isset($_POST['difficulte']) ? verifyInput($_POST['difficulte']): '';
    $detail = isset($_POST['detail']) ? verifyInput($_POST['detail']): '';
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
<link rel="stylesheet" href="css/style.css">
    
<!-- Attar Latifa 09/01/2024 Connaitre l'architecture du web-Exercice 2 - Développer une API-->
<!-- fichier index.php illustrant l'utilisation de mon API, permettant ainsi d'avoir une référence claire sur la 
façon d'utiliser l'API et de comprendre les fonctionnalités qu'elle offre.-->
<title>Interface de l'API de recettes</title>
       
</head>

<body class="body">  
    <?php
    // /////////////////////////////////////////////////////////////////////////////////////
    // ////////                              FORMULAIRE                             ////////
    // /////////////////////////////////////////////////////////////////////////////////////
// Vérifier si le formulaire de récupération des recettes et d'ajout de recette a éte soumis
if(isset($_GET['form-recette']) || isset($_POST['form-recette'])){
    // Response card
    echo'<div class="container col-md-8 p-3 my-5 mx-auto">';
        echo'<div class="card col-md-8 p-2 mx-auto text-center">';
         require_once('./API/recettes.php');
        echo'</div>';
    echo'</div>';
}
    ?>
<div class="container col-md-8 p-3 my-5 mx-auto">
    <div class="row g-5">
   
    <div class="col-md-6">
        <div>
            <h1 class="heading fig p-3 m-3">Récupérer la/les recette(s)</h1>
        </div>
     <!-- récupérer toutes les recettes de la base / récupérer une recette spécifique avec son numéro d’identification à laide d'un formulaire-->
        <form id="form-recette" method= "get" action="index.php">
            <div class="mb-3">
                <label for="id" class="form-label">ID de la recette</label>
                <input type="number" class="form-control" id="id" placeholder="Entrez un ID" name="id">
            </div>

            <div class="auto text-center">
                <input type="submit" class="button p-2 m-3" value="Récupérer la/les recettes" name="form-recette">
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <div>
            <h1 class="heading fig p-3 m-3">Ajouter une recette</h1>
        </div>
    <!-- ajouter une nouvelle recette à laide d'un formulaire-->    
        <form id="form-recette" method="post" action="index.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrez un nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" placeholder="Entrez un pays" name="pays" required>
            </div>

            <div class="mb-3">
                <label for="difficulte" class="form-label">Difficulté</label>
                <input type="number" class="form-control" id="difficulte" placeholder="Entrez une difficulté" name="difficulte" required >
            </div>

            <div class="mb-3">
                <label for="detail" class="form-label">Détail</label>
                <textarea class="form-control" id="detail" rows="3" name="detail" required></textarea>
            </div>

            <div class="col-auto text-center">
                <input type="submit" class="button p-2 m-3" value="Ajouter" name="form-recette">
            </div>
        </form>
    </div>
    </div>
</div>

</body>
</html>