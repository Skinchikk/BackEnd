<?php
header('Content-Type: application/xml; charset=utf-8');
session_start();
if($_SERVER['REQUEST_METHOD']=='POST') {
        $loginData = json_decode(file_get_contents('php://input'), true);
        if($loginData['login'] === 'admin' && $loginData['password'] === 'admin') {
            $_SESSION['user'] = 'admin';
            echo json_encode(array('login'=>true, 'user'=>$_SESSION['user']));
        }
        else {
            echo json_encode(array('login'=>false));
        }
    } 
    else {
        if(isset($_GET['action']) && $_GET['action'] === 'logout') {
            session_destroy();
            echo json_encode(array('login'=>false));
        } else if(!isset ($_SESSION['user'])) {
            echo json_encode(array('login'=>false));
        } else {
            echo json_encode(array('login'=>true, 'user'=>$_SESSION['user']));
        }
    }
?>