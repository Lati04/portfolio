<?php
require_once ('../Database.php');
require_once ('Class.php');
$database = new Database();
$dbh = $database->getConnection();

// class EntityManager parent gestionnaire  qui implémente les méthodes
class EntityManager{
    protected $db;  // Propriété protégée pour stocker l'objet de connexion a la base de données
    protected $table; // Propriété protégée pour stocker le nom de la table su laquelle exécuter les opérations d'insertions
    //protected $data; //  Propriété protégée pour stocker les données à insérer dans la base de données
    
    //Méthode pour définir la connexion à la base de données. 
    public function __construct($db){ 
        $this->setDb($db);
    }
    // prend en argument un objet PDO $dbh et le stocke dans la propriété $db
    public function setDb(PDO $dbh){
        $this->db = $dbh;
    }

    // Méthode pour récuperer les données d'une table à partie de la base de données
    public function getData($table){
        $result = array();
        $sql = "SELECT * FROM $table";
        $stmt = $this->db->prepare($sql);
      
        // Gestion des erreurs SQL
        try {
            $stmt->execute(); // Exécution de la requete 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $result [] = $row;
            }
            
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
        return $result;
    }

     // Méthode pour récuperer les données d'une table à partie de la base de données par colonne
     public function getDataBy($table, $column, $value){
       
        $sql = "SELECT * FROM $table WHERE $column = :value";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':value', $value);
      
        // Gestion des erreurs SQL
        try {
            $stmt->execute(); // Exécution de la requete 
            // Retourner les données
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérifier si les données existent 
            if($result){
                return $result;
            }else{
                return array(); // Retourner un tableau vide si aucune donnée trouvée
            }
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
        
    }

    // Méthode pour insérer les données à stocker  dans la base de données
    public function addData ($table, $data){
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO $table($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);
        
        // Gestion des erreurs SQL
        try {
            $stmt->execute(array_values($data));
          
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
    }
}

class ClientManager extends EntityManager{

}

class HotelManager extends EntityManager{
    
}

class  RoomsManager extends EntityManager{

}

class BookingManager extends EntityManager{
    protected $dt_deb_reservation;
    protected $dt_fin_reservation;
    protected $id_hotel;
    protected $roomId;

    // Méthode pour obtenir la première chambre disponible en fonction de la période de réservation
    public function getFirstAvailableRoom($dt_deb_reservation, $dt_fin_reservation, $id_hotel){
        
        // Requete SQL pour obtenir la première chambre disponible 
        $sql = "SELECT r.id, r.number_rooms, r.id_hotel FROM rooms r 
        WHERE r.id_hotel = :id_hotel AND r.id NOT IN 
        (SELECT b.id_room FROM booking b WHERE 
        b.dt_deb_reservation <= :dt_fin_reservation
        AND b.dt_fin_reservation > :dt_deb_reservation)
        ORDER BY r.id
        LIMIT 1";
         
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_hotel', $id_hotel);
        $stmt->bindParam(':dt_deb_reservation', $dt_deb_reservation);
        $stmt->bindParam(':dt_fin_reservation', $dt_fin_reservation);
        
        // Gestion des erreurs SQL
        try {
        $stmt->execute();
        // Retourner uniquement la première chambre disponible
        return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            echo 'Erreur SQL:' . $e->getMessage();
            return null;
        }
    }
    
    // Méthode pour récupérer le dernier id de la table booking
    public function getLastInsertedId(){
        return $this->db->lastInsertId();
    }
}
?>