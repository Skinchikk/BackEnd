<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../Coffee_machinesList.php';

$cml = new Coffee_machinesList();
$row = 0;
if (($handle = fopen("../data/Coffee_machines.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array(
                'model' => $data[0],
                'producer' => $data[1],
                'type' => $data[2],
                'coffee_type' => $data[3],
                'power_type' => $data[4]);
            $cml->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $cml -> exportAsXML();