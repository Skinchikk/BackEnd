<?php
require_once '../app/BaseList.php';
require_once '../app/Power_types.php';

class Power_typesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $power_type = new Power_types($this->lastId, $params['power_type']);
        array_push ($this->list, $power_type);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['power_type']);
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['power_type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Power_types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Power_types>';
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Power_types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('power_type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Power_types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}