<?php
class Employee {
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $id;
    public $name;
    public $dateOfBirth;
    public $country;
    public $userName;
    public $hiringDate;
    public $state;
    public $area;
    public $jobTitle;
    public $commission;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // Queries
    // read All
    function readAll() {
        $query = "SELECT id, name, date_of_birth, country, username, hiring_date, state,
                    area, jobTitle, commission 
                    FROM tbl_employee";
        // prepare query statement
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read one
    function readOne(){
        // select all query
        $query = "SELECT id, name, date_of_birth, country, username, hiring_date, state,
                    area, jobTitle, commission 
                    FROM tbl_employee WHERE id = ?";
        // prepare query statement
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Create
    function create(){
        $query = "INSERT INTO tbl_employee 
                (id, name, date_of_birth, country, username, hiring_date, state, area, jobTitle, commission)
                values (?,?,?,?,?,?,?,?,?,?)";
        
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->name);
        $stmt->bindParam(3, $this->dateOfBirth);
        $stmt->bindParam(4, $this->country);
        $stmt->bindParam(5, $this->userName);
        $stmt->bindParam(6, $this->hiringDate);
        $stmt->bindParam(7, $this->state);
        $stmt->bindParam(8, $this->area);
        $stmt->bindParam(9, $this->jobTitle);
        $stmt->bindParam(10, $this->commission);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Update
    function update(){
        function update(){
        
            // select all query
            $query = "UPDATE tbl_employee
                        SET  name = :name, date_of_birth = :date_of_birth, country = :country, username = :username, 
                        hiring_date = :hiring_date, state = :state, area = :area, jobTitle = :jobTitle, 
                        commission = :commission
                        WHERE id = :id";
            // prepare query statement
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':date_of_birth', $this->dateOfBirth);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':username', $this->userName);
            $stmt->bindParam(':hiring_date', $this->hiringDate);
            $stmt->bindParam(':state', $this->state);
            $stmt->bindParam(':area', $this->area);
            $stmt->bindParam(':jobTitle', $this->jobTitle);
            $stmt->bindParam(':commission', $this->commission);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

    // Delete
    function delete(){
        // select all query
        $query = "DELETE FROM tbl_employee WHERE id = ?";
        // prepare query statement
        $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(1, $this->id);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>