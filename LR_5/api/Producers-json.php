<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/ProducersList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$pl = new ProducersList();
$pl -> readFromFile();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->add($pdata);
    $pl->saveToFile();
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->update($pdata);
    $pl->saveToFile();
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $pdata = json_decode(file_get_contents('php://input'), true);
    $pl->delete($pdata['id']);
    $pl->saveToFile();
}
echo $pl -> exportAsJSON();