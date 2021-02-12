<?php
include_once '../../bootstrap.php';
include_once '../model/Measurement.php';
include_once '../config/DatabaseConnector.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$url = $_SERVER['REQUEST_URI'];
$urls = explode('/', $url);
$id = end($urls);

$connection = new DatabaseConnector();
$measurement = new Measurement($connection->getConnection());

$input = (array) json_decode(file_get_contents('php://input'), TRUE);

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': if ($id !== "measurements.php")
                    print_r (json_encode($measurement->read($id)));
                else
                    print_r (json_encode($measurement->readAll()));
                break;
    case 'POST': print_r($measurement->create($input));
                break;
    case 'PUT': print_r($measurement->update($input, $id));
                break;
    case 'DELETE': print_r($measurement->delete($id));
                break;
}