<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/Power_typesList.php';
require_once '../app/dbconnect.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$ptl = new Power_typesList();
$ptl->getAllFromDB($conn);
if($_SERVER['REQUEST_METHOD']=='POST') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->addToDB($conn, $ptdata);
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->updateDB($conn, $ptdata);
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $ptdata = json_decode(file_get_contents('php://input'), true);
    $ptl->deleteFromDB($conn, $ptdata['id']);
}
echo $ptl -> exportAsJSON();