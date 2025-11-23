<?php
require_once '../app/BaseList.php';
require_once '../app/Coffee_types.php';

class Coffee_typesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $coffee_type = new Coffee_types($this->lastId, $params['coffee_type']);
        array_push ($this->list, $coffee_type);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['coffee_type']);
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['coffee_type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Coffee_types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Coffee_types>';
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Coffee_types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('coffee_type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Coffee_types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}