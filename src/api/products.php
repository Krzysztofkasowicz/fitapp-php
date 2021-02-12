<?php
include_once '../../bootstrap.php';
include_once '../model/Product.php';
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
$products = new Product($connection->getConnection());

$input = (array) json_decode(file_get_contents('php://input'), TRUE);

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': if ($id !== "products.php")
        print_r($products->read($id));
    else
        print_r($products->readAll());
        break;
    case 'POST': print_r($products->create($input));
        break;
    case 'PUT': print_r($products->update($input, $id));
        break;
    case 'DELETE': print_r($products->delete($id));
        break;
}