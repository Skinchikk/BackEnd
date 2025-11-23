<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/TypesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$tl = new TypesList();
$tl->readFromFile();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->add($tdata);
    $tl->saveToFile();
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->update($tdata);
    $tl->saveToFile();
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->delete($tdata['id']);
    $tl->saveToFile();
}
echo $tl -> exportAsJSON();