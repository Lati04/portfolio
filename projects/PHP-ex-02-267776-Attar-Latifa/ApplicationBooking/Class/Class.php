<?php
require_once ('../Database.php');
$database = new Database();
$dbh = $database->getConnection();

class Entity{
    protected $id, $name;
    protected static $error; // Déclaration de l'attribut statique $error
    
    // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_ID = 'ID doit être un entier positif.';
    const MSG_ERROR_NOM = 'NOM doit être une chaine de caractère.Le nom est requis';
    const MSG_ERROR_END = "L\'objet ne peut pas être créé.";
    /* le constructeur intégre désormais unne vérification de $error
    il lance une exception si $error n'est pas vide  */

     //
     public function __construct(array $data){
        $this->setId($data['id']); // Définition du id
        $this->setName($data['name']); // Définition de name
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
   
     /////////////////////// Les setters //////////////////////////
     public function setId($id){
        // Affecte à $id la valeur $id passée en argument
        if(is_null($id) || (is_int($id) && $id > 0)){
            // Vérifie si $id
            $this->id = $id;// Définition de id 
        }
        else {
            $this->setError(self::MSG_ERROR_ID);
        }
    }

    public function setName($name){
        // Affecte à $name la valeur $name passée en argument
        if(is_string($name) && !empty($name)){
            // Vérifie si $name est une chaine de caractère non vide
            $this->name = $name;// Définition  de name
        }
        else {
            $this->setError(self::MSG_ERROR_NOM);
        }
    }
    
      //////////////////// Les getters/////////////////////////
      public function getId(){
        // Permet de récupérer la valeur de l'attribut  $id
        return $this->id;
    }

    public function getName(){
        // Permet de récupérer la valeur de l'attribut  $name
        return $this->name;
    }

}

class client extends Entity{
    protected $email, $id_booking;

     // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_EMAIL = 'EMAIL doit être une chainre de caratère.';
    const MSG_ERROR_ID_BOOKING = 'ID_BOOKING doit être un entier positif.';
    /*le constructeur intégre désormais une vérification de $error
      il lance une exception si $error n'est pas vide  
      Le constructeur appelle à la fois le constructeur de la classe mère 
      ainsi que les méthodes setId et setName*/
    public function __construct(array $data)
    {
         // appel du constructeur de la classe parent
         parent::__construct($data);
       
         // appel dans le constructeur du setter
         $this->setEmail($data['email']); // Définition de l' identifiant de l'email
        // utilisation de self:: pour accéder à error
         if (!empty(self::$error)){
            throw new Exception(self::$error . self:: MSG_ERROR_END);
        }
    }

    //////////////////////// Les setters ///////////////////////////
   
    public function setEmail($email){
        // Affecte à $email la valeur $email passée en argument
        if(is_string($email) && !empty($email)){
           // Vérifie si $email est une chaine de caractère non vide
           $this->email = $email;// Définition  de l'email
       }
        else {
            $this->setError(self::MSG_ERROR_EMAIL);
        }
    }

    public function setIdBooking($id_booking){
        // Affecte à $id_booking la valeur $id_booking passée en argument
        if(is_null($id_booking) || (is_int($id_booking) && $id_booking > 0)){
            // Vérifie si $id_booking
            $this->id_booking = $id_booking;// Définition de id_booking
        }
        else {
            $this->setError(self::MSG_ERROR_ID_HOTEL);
        }
    }

    ///////////////////////// Les getters ///////////////////////////
    public function getEmail(){
        // Permet de récupérer la valeur de l'attribut  $email
        return $this->email;
    }

    public function getIdBooking(){
        // Permet de récupérer la valeur de l'attribut  $id_booking
        return $this->id_booking;
    }
}

class Hotel extends Entity{
    protected $adress;

     // déclaration des messages d'erreur dans des constantes 
    const MSG_ERROR_ADRESS = 'ADRESS doit être une chainre de caratère.';
    /*le constructeur intégre désormais une vérification de $error
      il lance une exception si $error n'est pas vide  
      Le constructeur appelle à la fois le constructeur de la classe mère 
      ainsi que les méthodes setId et setName*/
    public function __construct(array $data)
    {
         // appel du constructeur de la classe parent
         parent::__construct($data);
       
         // appel dans le constructeur du setter
         $this->setAdress($data['adress']); // Définition de l' identifiant de l'adresse
        // utilisation de self:: pour accéder à error
         if (!empty(self::$error)){
            throw new Exception(self::$error . self:: MSG_ERROR_END);
        }
    }

    //////////////////////////// Le setter //////////////////////////
    public function setAdress($adress){
        // Affecte à $adress la valeur $adress passée en argument
        if(is_string($adress) && !empty($adress)){
           // Vérifie si $adress est une chaine de caractère non vide
           $this->adress = $adress;// Définition  de l'adress
       }
        else {
            $this->setError(self::MSG_ERROR_HOTEL);
        }
    }

    ////////////////////////// Le getter //////////////////////////
    public function getAdress(){
        // Permet de récupérer la valeur de l'attribut  $hotel
        return $this->adress;
    }
}

class Rooms extends Entity{
    protected $numberRooms, $id_hotel;
   
        // déclaration des messages d'erreur dans des constantes 
        const MSG_ERROR_NUMBER_ROOMS = 'NUMBER_ROOMS doit être un entier.';
        const MSG_ERROR_ID_HOTEL = 'ID_HOTEL doit être un entier positif.';
        public function __construct(array $data)
        { 
            // appel dans le constructeur du setter
            $this->setNumberRooms($data['number_rooms']); // Définition de l' identifiant de la chambre
            $this->setIdHotel($data['id_hotel']); // Définition de l' identifiant de la clé étrangère id_hotel de la chambre
            $this->setName(null);
        }    
       
        ///////////////////////////// Les setters //////////////////////////////////
        public function setNumberRooms($numberRooms){
            // Affecte à $numberRooms la valeur $numberRooms passée en argument
            if(is_int($numberRooms) && !empty($numberRooms)){
               // Vérifie si $numberRooms est un numéro non vide
               $this->numberRooms = $numberRooms;// Définition  du numéro de chambres
           }
            else {
                $this->setError(self::MSG_ERROR_NUMBER_ROOMS);
            }
        }
    
        public function setIdHotel($id_hotel){
            // Affecte à $id_hotel la valeur $id_hotel passée en argument
            if(is_int($id_hotel) && $id_hotel > 0){
                // Vérifie si $id_hotel
                $this->id_hotel = $id_hotel;// Définition de id 
            }
            else {
                $this->setError(self::MSG_ERROR_ID_HOTEL);
            }
        }

        public function setName($name){
            // Annule la définition de la propriété $name
            $this->name = null;
        }
    
        ///////////////////////////// Les getters //////////////////////////
        public function getNumberRooms(){
            // Permet de récupérer la valeur de l'attribut  $numberChambres
            return $this->numberRooms;
        }

        public function getIdHotel(){
            // Permet de récupérer la valeur de l'attribut  $id_hotel
            return $this->id_hotel;
        }

}

class Booking extends Entity{
    protected $dt_deb_reservation, $dt_fin_reservation, $dt_creation, $id_room; 
   
        // déclaration des messages d'erreur dans des constantes 
        const MSG_ERROR_DT_DEB_RESERVATION = 'DT_DEB_RESERVATION doit être une date. La date de début de reservation est requise';
        const MSG_ERROR_DT_FIN_RESERVATION = 'DT_FIN_RESERVATION doit être une date. La date de fin de reservation est requise';
        const MSG_ERROR_DT_CREATION = 'DT_CREATION doit être une date. La date de création est requise';
        const MSG_ERROR_ID_ROOM = 'ID_ROOM doit être un entier positif.';

        public function __construct(array $data)
        { 
            // appel dans le constructeur du setter
            $this->setDt_Deb_Reservation($data['dt_deb_reservation']); // Définition du Deb_Reservation
            $this->setDt_Fin_Reservation($data['dt_fin_reservation']); // Définition du Fin_Reservation
            $this->setDt_Creation($data['dt_creation']); // Définition du Dt_Creation
            $this->setIdRoom($data['id_room']); // Définition de l' identifiant de la clé étrangère id_room de la chambre
            $this->setName(null);
        }    
       
            ////////////////////////////////// Les setters  /////////////////////////////////////////////
        public function setDt_Deb_Reservation($dt_deb_reservation){
            if ($dt_deb_reservation !== null){
                list($y, $m, $d) = explode('-', $dt_deb_reservation);
                // Affecte à $dt_Deb_Reservation la valeur $dt_Deb_Reservation passée en argument
                if(checkdate($m, $d, $y)){
                    // Vérifie si $dt_Deb_Reservation est une date
                    $this->dt_deb_reservation = $dt_deb_reservation;// Définition  de dt_Deb_Reservation
                }
                else {
                    $this->setError(self::MSG_ERROR_DT_DEB_RESERVATION);
                }
            }
           
        }

        public function setDt_Fin_Reservation($dt_fin_reservation){
            if ($dt_fin_reservation !== null){
                list($y, $m, $d) = explode('-', $dt_fin_reservation);
                // Affecte à $dt_FinReservation la valeur $dt_Fin_Reservation passée en argument
                if(checkdate($m, $d, $y)){
                    // Vérifie si $dt_Fin_Reservation est une data
                    $this->dt_fin_reservation = $dt_fin_reservation;// Définition de dt_Fin_Reservation
                }
                else {
                    $this->setError(self::MSG_ERROR_DT_FIN_RESERVATION);
                }
            }
        }

        public function setDt_Creation($dt_creation){
            if ($dt_creation !== null){
                list($y, $m, $d) = explode('-', $dt_creation);
                // Affecte à $dt_Creation la valeur $dt_Creationpassée en argument
                if(checkdate($m, $d, $y)){
                    // Vérifie si $dt_Creation est une data
                    $this->dt_creation = $dt_creation;// Définition  de dt_Creation
                }
                else {
                    $this->setError(self::MSG_ERROR_DT_CREATION);
                }
            }
        }
    
        public function setIdRoom($id_room){
            // Affecte à $id_room la valeur $id_room passée en argument
            if(is_int($id_room) && $id_room > 0){
                // Vérifie si $id_hotel
                $this->id_room = $id_room;// Définition de id_room
            }
            else {
                $this->setError(self::MSG_ERROR_ID_ROOM);
            }
        }

        public function setName($name){
            // Annule la définition de la propriété $name
            $this->name = null;
        }
    
        ////////////////////////////////// Le getter //////////////////////////////
        public function getDt_deb_reservation(){
            // Permet de récupérer la valeur de l'attribut  $Dt_Deb_Reservation
            return $this->dt_deb_reservation;
        }
    
        public function getDt_fin_reservation(){
            // Permet de récupérer la valeur de l'attribut  $Dt_Fin_Reservation
            return $this->dt_fin_reservation;
        }
    
        public function getDt_creation(){
            // Permet de récupérer la valeur de l'attribut  $Dt_Creation
            return $this->dt_creation;
        }

        public function getIdRoom(){
            // Permet de récupérer la valeur de l'attribut  $id_room
            return $this->id_room;
        }
}