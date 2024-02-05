<?php
// class API_Functions  qui implémente les méthodes
class API_Functions{
    private $db; // Propriété protégée pour stocker l'objet de connexion a la base de données

    
    //Méthode pour définir la connexion à la base de données. 
    public function __construct($db){ 
        $this->setDb($db);
    }
    // prend en argument un objet PDO $pdo et le stocke dans la propriété $db
    public function setDb(PDO $pdo){
        $this->db = $pdo;
    }

    // Méthode pour ajouter les données à la table de la base de données
    function postRecettes($nom, $pays, $difficulte, $detail){

        // Préparons la requête d'insertion
        $sql = "INSERT INTO recettes (nom, pays, difficulte, detail) VALUES (:nom, :pays, :difficulte, :detail)";
   
        // Préparation de la requête avec l'objet de connexion à la base de données($this->db)
        $request = $this->db->prepare($sql);

        // Ajoutons les paramètres variables dans la requête
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':pays', $pays, PDO::PARAM_STR);
        $request->bindParam(':difficulte', $difficulte, PDO::PARAM_INT);
        $request->bindParam(':detail', $detail, PDO::PARAM_STR);
    
        //Exécutons la requête
        $request->execute();
    }

    // Méthode pour récupérer des données
    function getRecettes($id) {
     
        if(is_numeric($id)){
            // Si un $id est présent et est une valeur numérique , alors préparons la requête pour récupérer la recette demandée
            $sql = "SELECT * FROM recettes WHERE id = :id";
            $request = $this->db->prepare($sql);

            // Ajoutons le paramètre $id dzns la requête 
            $request->bindParam(':id', $id);
        }else{
            // Sinon, préparons la requête pour récupérer totes les recettes 
            $sql = "SELECT * FROM recettes";
            $request = $this->db->prepare($sql);
        }

        // Exécutons la requête 
        $request->execute();

        // Créons et alimentons le tableau $recettes avec les résultats de la requête
        $recettes = array();
        while($recette = $request->fetch(PDO::FETCH_ASSOC)){

            // Chaque recette récupéré est ajouté au tableau 
            $recettes[] = $recette;
        }

        // Le résutat de la fonction est la liste des recettes récupérées
        return $recettes;
    }
}
?>