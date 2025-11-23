<?php
require_once '../app/BaseList.php';
require_once '../app/Types.php';

class TypesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $type = new Types($this->lastId, $params['type']);
        array_push ($this->list, $type);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['type']);
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Types>';
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}