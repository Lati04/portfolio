<?php
// Connexion à la base de donnée
class DB_config {
    private $host = "localhost";
    private $db_name = "recettes_api";
    private $username = "root";
    private $password = '';

    public function getConnection(){
        try{
            $dsn ='mysql:host='. $this->host.';dbname='.$this->db_name;
            $pdo =new PDO($dsn, $this->username, $this->password);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo 'Erreur de connexion à la base de données:'. $e->getMessage();
        }
        return $pdo;
    }
}
?>