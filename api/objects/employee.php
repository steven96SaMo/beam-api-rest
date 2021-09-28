<?php
class Employee {
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_employee";
 
    // object properties
    public $AttendeeId;
    public $EventId;
    public $ProjectId;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // Queries
    // read All
    function readAll() {
        $query = "SELECT id, name, date_of_birth, country, username, hiring_date, state,
                    area, jobTitle, commission 
                    FROM " . "[" . $this->table_name . "]" . "";
        // prepare query statement
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
?>