<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../Power_typesList.php';

$ptl = new Power_typesList();
$row = 0;
if (($handle = fopen("../data/Power_types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('power_type' => $data[0]);
            $ptl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $ptl -> exportAsJSON();