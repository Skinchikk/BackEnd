<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../app/Coffee_machinesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$cml = new Coffee_machinesList();
$row = 0;
if (($handle = fopen("../data/Coffee_machines.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array(
                'model' => $data[0],
                'producer_id' => $data[1],
                'type_id' => $data[2],
                'coffee_type_id' => $data[3],
                'power_type_id' => $data[4]);
            $cml->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $cml -> exportAsXML();