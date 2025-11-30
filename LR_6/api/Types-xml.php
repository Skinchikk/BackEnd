<?php
header('Content-Type: application/xml; charset=utf-8');
require_once '../app/TypesList.php';

session_start();
if(!isset ($_SESSION['user'])) {
    echo json_encode(array('login'=>false));
    die();
}

$tl = new TypesList();
$row = 0;
if (($handle = fopen("../data/Types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('type' => $data[0]);
            $tl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
echo $tl -> exportAsXML();