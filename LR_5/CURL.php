<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/BE/LR_4/api/Producers-json.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($output, true);
    foreach ($data as $item) {
        echo $item['id'].'. '.$item['name'].'</br>';
    }