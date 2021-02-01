<?php
include_once '../../bootstrap.php';
include_once '../model/User.php';
include_once '../config/DatabaseConnector.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$url = $_SERVER['REQUEST_URI'];
$urls = explode('/', $url);

$connection = new DatabaseConnector();
$user = new User($connection->getConnection());

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET': if (end($urls) !== "users.php")
                    print_r($user->read(end($urls)));
                else
                    print_r($user->readAll());
                break;
    case 'POST': break;
    case 'PUT': break;
    case 'DELETE': break;
    default: echo 'test';
    break;
}