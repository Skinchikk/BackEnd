<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/Coffee_typesList.php';
require_once '../app/dbconnect.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$ctl = new Coffee_typesList();
$ctl->getAllFromDB($conn);
if($_SERVER['REQUEST_METHOD']=='POST') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->addToDB($conn, $ctdata);
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->updateDB($conn, $ctdata);
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $ctdata = json_decode(file_get_contents('php://input'), true);
    $ctl->deleteFromDB($conn, $ctdata['id']);
}
echo $ctl -> exportAsJSON();