<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../app/Coffee_typesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$ctl = new Coffee_typesList();
$row = 0;
if (($handle = fopen("../data/Coffee_types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('coffee_type' => $data[0]);
            $ctl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $ctl -> exportAsXML();