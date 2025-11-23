<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../app/ProducersList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$pl = new ProducersList();
$row = 0;
if (($handle = fopen("../data/Producers.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('name' => $data[0]);
            $pl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $pl -> exportAsXML();