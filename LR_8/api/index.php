<?php
require_once '../dbconnect.php';
session_start();
$path = $_GET['path'] ?? '';
if(str_contains($_SERVER['REQUEST_URI'], 'Coffee_machines')) {
    require_once '../controllers/CoffeeMachinesController.php';
} 
else if(str_contains($_SERVER['REQUEST_URI'], 'Coffee_types')) {
    require_once '../controllers/CoffeeTypesController.php';
}
else if(str_contains($_SERVER['REQUEST_URI'], 'Producers')) {
    require_once '../controllers/ProducersController.php';
}
else if(str_contains($_SERVER['REQUEST_URI'], 'Types')) {
    require_once '../controllers/TypesController.php';
}
else if(str_contains($_SERVER['REQUEST_URI'], 'Power_types')) {
    require_once '../controllers/PowerTypesController.php';
}
else if($path === 'profile') {
    require_once '../controllers/ProfileController.php';
}