<?php
require_once('db_config.php');
require_once('api_functions.php');
// Connexion à la base de données en PDO
$db = new DB_config();
$pdo = $db->getConnection();

//
$api = new API_Functions($pdo);
// TEST:
// $_SERVER ["REQUEST_METHOD"] = 'POST';
// $_POST ['nom'] = 'Tarte à la citrouille traditionnelle';
// $_POST ['pays'] = 'Argentine';
// $_POST ['difficulte'] = 0;
// $_POST ['detail'] = "Faites cuire la chair de potiron dans une casserole d'eau bouillante pendant 15 min environ. Égouttez et réduisez en purée. Réservez.
// Disposez la pâte feuilletée dans un plat à tarte. Piquez le fond à l'aide d'une fourchette et faites cuire la pâte à blanc pendant 10 min (four préchauffé à 170°C).
// Dans un saladier, mélangez la purée de potiron, les œufs, le sucre, la crème liquide et les épices. Versez cette préparation sur le fond de tarte précuit.
// Enfournez la tarte à la citrouille pendant environ 1 heure à 150°C. Lorsque la garniture est bien ferme, sortez la tarte du four et laissez-
// la refroidir avant de la déguster";

switch($_SERVER["REQUEST_METHOD"]){
    case 'POST':
        
        // Vérifions que les données requises sont bien présentes
        if(!empty($_POST["nom"]) || !empty($_POST["pays"]) || !empty($_POST["difficulte"]) || !empty($_POST["detail"])){
         
            // Vérifions que les données envoyées correspondent au format attendus,
            // et sinon envoyons une réponse décrivant l'erruer
            if(!is_string($_POST['nom']) || strlen($_POST['nom']) >50){
                $response = [ 
                    'success' => false,
                    'content' => 'Le nom doit être une chaîne de 50 caractères ou moins',
                ];
            }elseif(!is_string($_POST['pays']) || strlen($_POST['pays']) >50){
                $response = [ 
                    'success' => false,
                    'content' => 'Le pays doit être une chaîne de 50 caractères ou moins',
                ];
            }elseif(!is_numeric($_POST['difficulte']) || $_POST['difficulte'] < 0 && $_POST['difficulte'] !=0 || $_POST['difficulte'] > 5)  {
                $response = [ 
                    'success' => false,
                    'content' => 'La difficulté doit être compris entre 0 et 5',
                ];
            }elseif(strlen($_POST['detail']) > 65000){
                $response = [ 
                    'success' => false,
                    'content' => 'Le detail ne doit pas dépasser 65 000 caractères',
                ];
             
            }else{
                // Les sont valides !
                // Appelons la fonction d'ajout dans la base
                $api->postRecettes($_POST['nom'], $_POST['pays'], $_POST['difficulte'], $_POST['detail']);

                // Préparons une réponse annonçant le succès de l'enregistrement
                $response = [
                    'success' => true,
                    'content' => 'Recette ajoutée avec succès',
                ];
            }
           
        }else{
            // Préparons une réponse annonçant que les données sont manquantes
            $response = [ 
                'success' => false,
                'content' => 'Informations manquantes : nom, pays, difficulte, et detail sont requises,
                Veuillez fournir toutes les informations necessaires',
            ];
        }
        break;
    
    case 'GET':
        // Appelons la fonction de récupération avec l'id demandé s'il existe , sinon avec null
        if(!empty($_GET['id']))
            $recettes = $api->getRecettes($_GET['id']);
        else
            $recettes = $api->getRecettes(null);
        
        // Préparons une réponse contenant le tableau des recettes récupérés
        $response = [
            'success' => true,
            'content' => $recettes,
        ];
        
        break;
    
    default:
        // Requête invalide
        header('HTTP/1.0 405 Method Not Allowed');
        break;
}

// Une réponse est-elle prête?
    if(!empty($response)){
   
        // Le header précise le format de notre contenu
        header('Content-type : application/json; charset=utf-8');
    
        // Nous encondons notre réponse en JSON
        $json = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }
?>