<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/employee.php';
    // instantiate database
    $database = new Database();
    $db = $database->getConnection();
    
    // initialize object
    $employee = new Employee($db);    

    try {
        $stmt = $employee->readAll();
        $num = $stmt->rowCount();
        // check if more than 0 record found
        if($num>0) {
            $employee_array=array();
            $employee_array["results"]=array();
            
            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                extract($row);
                $employee_item=array(
                    "id" => $id,
                    "name" => html_entity_decode($name),
                    "dateOfBirth" => html_entity_decode($date_of_birth),
                    "country" => html_entity_decode($country),
                    "userName" => html_entity_decode($username),
                    "hiringDate" => html_entity_decode($hiring_date),
                    "state" => html_entity_decode($state),
                    "area" => html_entity_decode($area),
                    "jobTitle" => html_entity_decode($jobTitle),
                    "commission" => html_entity_decode($commission),
                );
                array_push($employee_array["results"], $employee_item);
            }
            echo json_encode($employee_array, JSON_UNESCAPED_UNICODE);
        }
        else{
            echo json_encode(
                array("message" => "No Employees."), JSON_UNESCAPED_UNICODE
            );
        }
    } catch (Exception $e) {
        echo json_encode(
            array("message2" => $e->getMessage()), JSON_UNESCAPED_UNICODE
        );
    }
?>