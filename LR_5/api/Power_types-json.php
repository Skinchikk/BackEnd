<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/Power_typesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$ptl = new Power_typesList();
$ptl->readFromFile();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->add($ptdata);
    $ptl->saveToFile();
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->update($ptdata);
    $ptl->saveToFile();
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->delete($ptdata['id']);
    $ptl->saveToFile();
}
echo $ptl -> exportAsJSON();