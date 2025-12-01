<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../models/Coffee_machinesList.php';

if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$cml = new Coffee_machinesList();
$cml -> getAllFromDB($conn);
if($_SERVER['REQUEST_METHOD']=='POST') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->addToDB($conn, $cmdata);
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->updateDB($conn, $cmdata);
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->deleteFromDB($conn, $cmdata['id']);
}
echo $cml -> exportAsJSON();