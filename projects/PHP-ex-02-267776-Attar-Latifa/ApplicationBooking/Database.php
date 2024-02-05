<?php 
class Database{
    private $host = 'localhost';
    private $db_name = 'application_booking';
    private $username = 'root';
    private $password = '';
    public function getConnection(){ // Retourne une connexion à la base de données
      
        try{
            $dsn ='mysql:host='. $this->host.';dbname='.$this->db_name;
            $dbh =new PDO($dsn, $this->username, $this->password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo 'Erreur de connexion à la base de données:'. $e->getMessage();
        }
        return $dbh;
    }
}
?>