<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/Coffee_machinesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$cml = new Coffee_machinesList();
$cml->readFromFile();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->add($cmdata);
    $cml->saveToFile();
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->update($cmdata);
    $cml->saveToFile();
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $cmdata = json_decode(file_get_contents('php://input'), true);
    $cml->delete($cmdata['id']);
    $cml->saveToFile();
}
echo $cml -> exportAsJSON();