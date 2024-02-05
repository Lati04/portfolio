<?php
require_once ('database.php');
require_once ('Class.php');
$database = new Database();
$dbh = $database->getConnection();

// class EntityManager parent gestionnaire  qui implémente la méthode addData
class EntityManager{
    protected $db;  // Propriété protégée pour stocker l'objet de connexion a la base de données
    protected $table; // Propriété protégée pour stocker le nom de la table su laquelle exécuter les opérations d'insertions
    protected $data; //  Propriété protégée pour stocker les données à insérer dans la base de données
    protected $last_id; // Propriété protégée pour stocker l'ID de la dernière insertion
    
    //Méthode pour définir la connexion à la base de données. 
    public function __construct($db){ 
        $this->setDb($db);
    }
    // prend en argument un objet PDO $dbh et le stocke dans la propriété $db
    public function setDb(PDO $dbh){
        $this->db = $dbh;
    }
    
    //Méthode pour générer et insérer un contenu aléatoire dans la base de connées      
    public function addData(string $table, $data){ 
    $this->table = $table; // Mise à jour avec le nom de la table fourni
    $this->data = $data; // Mise à jour avec les données fournies

        //Génération aléatoire du contenu avec une boucle foreach
        foreach($this->data as $key => &$value){
            if (is_array($value)){
            // Sélectionne alétoirement un nom d'école
                 $randomIndex = array_rand($value); //Utilisation de la fonction array_rand pour sélectionner 
                 // aléatoirement les indices des valeurs
                 $value = $value[$randomIndex];
            }
        }

        // Les chaines $fields et $placeholders sont générées à partir des clés des donnéées
        $fields = implode(',', array_keys($this->data)); // Contient les noms de colonnes séparés par des virgules
        $placeholders = implode(',', array_map(function($value){ // Contient les paramètres de paramètres
        return':'. $value;
        },array_keys($this->data)));
        // Requete utilisant les chaines puis chaque donnée est liée à son marqueur de paramètre à l'aide de bindParam
        $sql = "INSERT INTO $table($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
                
        foreach ($this->data as $key => &$value){
            $stmt->bindParam(':'.$key, $value);
        }
        // Gestion des erreurs SQL
        try {
            $stmt->execute(); // Exécution de la requete 
            $this->last_id = (int)$this->db->lastInsertId(); // Récupération du dernier ID inséré et stocké dans $last_id
            
            return $this->last_id;
            
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
    }
}
 
// class SchoolManager qui implémente les méthodes pour gérer les écoles dans la base de données.
class SchoolManager extends EntityManager{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////Méthode pour récuperer la liste des écoles avec le nombre d'élèves///////////////////////////////////
    public function getSchools(){
        $sql = "SELECT s.name, COUNT(p.id) as num_pupils 
                FROM school s
                INNER JOIN pupil p ON s.id = p.id_school
                GROUP BY s.name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $schools = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $schools[] = $row;
        }
        return $schools;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////// Méthode pour récuperer la liste des écoles avec le nombre d'élèves pratiquant au moins un sport//////
    public function getSchoolsAndPupils(){
        $sql = "SELECT s.name, COUNT(DISTINCT p.id) AS num_pupils
                FROM school s 
                INNER JOIN pupil p ON s.id = p.id_school
                LEFT JOIN pupil_sport p_s ON p.id = p_s.id_pupil
                LEFT JOIN sport sp ON p_s.id_sport = sp.id 
                WHERE sp.name <>''
                GROUP BY s.name
                HAVING COUNT(DISTINCT p.id) > 0";

        $stmt = $this->db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }        
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////// Methode pour récupérer le nombre d'activités sportives pratiquées par une école//////////////
    public function getSchoolsAndSports(){
        $sql = "SELECT s.name, COUNT(p_s.id_sport) AS num_sports
                FROM school s
                INNER JOIN pupil p ON s.id = p.id_school
                INNER JOIN ( 
                SELECT id_pupil, id_sport 
                FROM pupil_sport) p_s ON p.id = p_s.id_pupil
                INNER JOIN sport sp ON p_s.id_sport = sp.id
                WHERE sp.name <>''
                GROUP BY s.name";

        $stmt = $this->db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

//class PupillManager qui hérite de la méthode addData pour gérer les élèves dans la base de données.
class PupilManager extends EntityManager {
 
}

//class SportManager qui implémente les méthodes pour gérer les sports dans la base de donnéess.
class SportManager extends EntityManager{
    protected $table;
    protected $data;
    protected $randomNumber; // Stocke un nombre aléatoire généré par la méthode generateRandomNumber()

    // Méthode pour générer un nombre aléatoire entre 0 et 3
    public function generateRandomNumber(){
        return rand(0,3);
    }

    // Méthode pour insérer un sport dans la base de connées 
    public function addSport(string $table, $data){
        $this->table = $table;
        $this->data = $data;
        $this->randomNumber = $this->generateRandomNumber(); // Appel de la méthode generateRandomNumber() 
        //et stocké dans randomNumber
        
        // Si $randomNumber est > 0 , insertion des noms des sports 
        if($this->randomNumber > 0){
            $randomNumber = $this->randomNumber;
            $names = array_rand($data['name'], $randomNumber); // Utilisation de la fonction array_rand pour sélectionner 
            // aléatoirement les indices des noms de sport dans le tableau $data['name']

            if(!is_array($names)){// Méthode vérifiant si le résultat de array_rand est une seule ou un tableau
                    $names = [$names];  // Conversion en tableau contenant cette valeur
            }
            $selectedNames = [];  
            foreach ($names as $index){// Boucle foreach utilisé pour itérer sur les indices sélectionnés et les noms de 
                // sport correspondants sont récupérés dans le tableau $selectedNames
                $selectedNames[] = $data['name'][$index];
            }
        
            foreach ($selectedNames as $name){ // Boucle foreach utilisée pour itérer sur les noms de sport sélectionnés
                // et exécuté une requete d'insertion pour chaque nom
                $sql = "INSERT INTO $table(name) VALUES (:name)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':name', $name);
        
            // Gestion des erreurs SQL
            try {
                $stmt->execute();
                $this->last_id[] = (int)$this->db->lastInsertId();
                return $this->last_id;
                
            }catch(PDOException $e){
                echo 'Erreur SQL:' . $e->getMessage();
                return null;
            }
                
            }
            return $this->last_id;

        // Si $randomNumber est = à 0 pas d'insertion de nom de sport mais seulement des id genérés automatiquement   
        }elseif($this->randomNumber === 0){
                $randomNumber = $this->randomNumber;
                $sql = "INSERT INTO $table(id) VALUES (:id)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);

        // Gestion des erreurs SQL
            try {
                $stmt->execute();
                $this->last_id[] = (int)$this->db->lastInsertId();
                return $this->last_id;
                
            }catch(PDOException $e){
                echo 'Erreur SQL:' . $e->getMessage();
                return null;
            }
        } 
            
    }
}

//class PupillManager qui implémente les méthodes pour gérer les élèves et les activités sportives dans la base de données
class PupilSportManager extends EntityManager {
    protected $table;
    protected $data;    
    //Méthode pour insérer un élve et les activités sportives qu'ils pratiquent dans la base de connées 
    public function addPupilSport(string $table, $data){
        $this->table = $table; 
        $this->data = $data;

        $fields = implode(',', array_keys($this->data));
        $placeholders = implode(',', array_map(function($value){
        return':'. $value;
        },array_keys($this->data)));

        $sql = "INSERT INTO $table($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
                
        foreach ($this->data as $key => &$value){
            $stmt->bindParam(':'.$key, $value);
        }
        // Gestion des erreurs SQL
        try {
            $stmt->execute();
          
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////Méthode pour récupérer la liste des activités sportives pratiquées classées par orde croissant en ///////
////////////////fonction du nombre d'élèves qui les pratiquent et en précisant ce nombre pour chacune des activités /////
    public function getsportsByPupilsCount(){
        $sql = "SELECT sp.name AS sport_name, COUNT(p_s.id_pupil) AS num_pupils
                FROM sport sp
                LEFT JOIN pupil_sport p_s ON sp.id = p_s.id_sport
                WHERE sp.name <>''
                GROUP BY sp.name
                ORDER BY num_pupils
                ASC";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }        
    }
}
?>