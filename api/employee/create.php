<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/employee.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$employee = new Employee($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
$employee->id = isset($data->id) ? $data->id : die();
$employee->name = isset($data->name) ? $data->name : die();
$employee->dateOfBirth = isset($data->dateOfBirth) ? $data->dateOfBirth : die();
$employee->country = isset($data->country) ? $data->country : die();
$employee->userName = isset($data->userName) ? $data->userName : die();
$employee->hiringDate = isset($data->hiringDate) ? $data->hiringDate : die();
$employee->state = isset($data->state) ? $data->state : die();
$employee->area = isset($data->area) ? $data->area : die();
$employee->jobTitle = isset($data->jobTitle) ? $data->jobTitle : die();
$employee->commission = isset($data->commission) ? $data->commission : die();

// query access Log
try{
    // create the news
    if($employee->create()){
        echo '{';
            echo '"message": "Employee was created"';
        echo '}';
    }
    
    else{
        echo '{';
            echo '"message": "Error"';
        echo '}';
    }
} catch (Exception $e) {
    echo json_encode(
        array("message" => $e->getMessage()), JSON_UNESCAPED_UNICODE
    );
}
?>