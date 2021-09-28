<?php
class Database {    
    // server credentials
    private $host = "localhost";
    private $db_name = "beam_project";
    private $username = "root";
    private $password = "";

    public $conn;
 
    // get the database connection
    public function getConnection() {
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>