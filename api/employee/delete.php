<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employee.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize object
$employee = new Employee($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
$employee->id = isset($data->id) ? $data->id : die();

// query access Log
try{
    if($employee->delete()){
        echo json_encode(
            array("message" => "Employee was deleted"), JSON_UNESCAPED_UNICODE
        );
    } else {
        echo json_encode(
            array("message" => "Error"), JSON_UNESCAPED_UNICODE
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array("message" => $e->getMessage()), JSON_UNESCAPED_UNICODE
    );
}
?>