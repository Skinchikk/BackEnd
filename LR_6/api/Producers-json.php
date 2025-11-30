<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/ProducersList.php';
require_once '../app/dbconnect.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$pl = new ProducersList();
$pl -> getAllFromDB($conn);
if($_SERVER['REQUEST_METHOD']=='POST') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->addToDB($conn, $pdata);
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->updateDB($conn, $pdata);
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->deleteFromDB($conn, $pdata['id']);
}
echo $pl -> exportAsJSON();