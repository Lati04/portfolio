<?php
require_once ('database.php');
$database = new Database();
$dbh = $database->getConnection();

class Entity{
    //protected $id; // 
    protected $name = []; // 
    protected static $error; // Déclaration de l'attribut statique $error

    // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_NOM = 'NOM doit être une chaine de caractère.';
    const MSG_ERROR_END = "L\'objet ne peut pas être créé.";
    /* le constructeur intégre désormais unne vérification de $error
    il lance une exception si $error n'est pas vide  */

    public function __construct(array $data)
    {
        $name = implode(',', ($data['name'])); 
        $this->setName($name); // Définition de name
  
        // utilisation de self:: pour accéder à error
        if (!empty(self::$error)){
            throw new Exception(self::$error . self:: MSG_ERROR_END);
        }
    }

    // gestion des erreurs 
    public function setError($msg){
       self::$error = $msg;
    }
    public function getError(){
        return self::$error;
    }

    // Le setter
    public function setName($name){
        // Affecte à $name la valeur $name passée en argument
        if(is_string($name) && !empty($name)){
            // Vérifie si $name est une chaine de caractère non vide
            $this->name = $name;// Définition  
        }
        else {
            $this->setError(self::MSG_ERROR_NOM);
        }
    }

    // Le getter
    public function getName(){
        // Permet de récupérer la valeur de l'attribut  $name
        return $this->name;
    }
}

class School extends Entity {
    
}

class Pupil extends Entity{
    protected $id_school;// Identifiant 

     // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_ID_SCHOOL = 'ID_SCHOOL doit être un entier.';
    /*le constructeur intégre désormais une vérification de $error
      il lance une exception si $error n'est pas vide  
      Le constructeur appelle à la fois le constructeur de la classe mère 
      ainsi que la méthode setIdSchool.*/
    public function __construct(array $data)
    {
         // appel du constructeur de la classe parent
         parent::__construct($data);
       
         // appel dans le constructeur du setter
         $this->setIdSchool($data['id_school']); // Définition de l' identifiant de l'école
        // utilisation de self:: pour accéder à error
         if (!empty(self::$error)){
            throw new Exception(self::$error . self:: MSG_ERROR_END);
        }
    }

    // Le setter
    public function setIdSchool($id_school){
        // Affecte à $id_school la valeur $id_school passée en argument
        if(is_int($id_school) && $id_school > 0){
            // Vérifie si $id_school est un entier positif
            $this->id_school = $id_school; // Définition de l'identifiant de l'école
        }
        else {
            $this->setError(self::MSG_ERROR_ID_SCHOOL);
        }
    }

    // Le getter
    public function getIdSchool(){
        // Permet de récupérer la valeur de l'attribut  $id_school
        return $this->id_school;
    }
}

class Sport extends Entity{

}

class PupilSport extends Entity{
    protected $id_pupil;
    protected $id_sport;

    // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_ID = 'ID doit être un entier.';
    public function __construct(array $data)
    { 
        // appel dans le constructeur du setter
        $this->setIdPupil($data['id_pupil']); // Définition de l' identifiant de l'école de l'élève
        $this->setIdSport($data['id_sport']); // Définition de l' identifiant du sport 
        $this->setName(null);
    }    
   
    // Les setters
    public function setIdPupil($id_pupil){
        // Affecte à $id_pupil la valeur $id_pupil passée en argument
        if(is_int($id_pupil) && $id_pupil > 0){
            // Vérifie si $id_pupil est un entier positif
            $this->id_pupil = $id_pupil; // Définition de l'identifiant de l'élève
        }
        else {
            $this->setError(self::MSG_ERROR_ID);
        }
    }

    public function setIdSport($id_sport){
        // Affecte à $id_sport la valeur $id_sport passée en argument
        if(is_int($id_sport) && $id_sport > 0){
            // Vérifie si $id_sport est un entier positif
            $this->id_sport = $id_sport; // Définition de l'identifiant du sport
        }
        else {
            $this->setError(self::MSG_ERROR_ID);
        }
    }
    
    public function setName($name){
        // Annule la définition de la propriété $name
        $this->name = null;
    }

    // Les getters
    public function getIdPupil(){
        // Permet de récupérer la valeur de l'attribut  $id_pupil
        return $this->id_pupil;
    }
    public function getIdSport(){
        // Permet de récupérer la valeur de l'attribut  $id_sport
        return $this->id_sport;
    }
}
?>
