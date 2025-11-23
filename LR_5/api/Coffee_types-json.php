<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/Coffee_typesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$ctl = new Coffee_typesList();
$ctl->readFromFile();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->add($ctdata);
    $ctl->saveToFile();
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->update($ctdata);
    $ctl->saveToFile();
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->delete($ctdata['id']);
    $ctl->saveToFile();
}
echo $ctl -> exportAsJSON();