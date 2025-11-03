<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../ProducersList.php';

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