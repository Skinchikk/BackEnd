<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../app/TypesList.php';
require_once '../app/dbconnect.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$tl = new TypesList();
$tl->getAllFromDB($conn);
if($_SERVER['REQUEST_METHOD']=='POST') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->addToDB($conn, $tdata);
} 
else if($_SERVER['REQUEST_METHOD']=='PUT') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->updateDB($conn, $tdata);
}
else if($_SERVER['REQUEST_METHOD']=='DELETE') {
    $tdata = json_decode(file_get_contents('php://input'), true);
    $tl->deleteFromDB($conn, $tdata['id']);
}
echo $tl -> exportAsJSON();