<?php
require_once '../app/BaseList.php';
require_once '../app/Producers.php';

class ProducersList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $producer = new Producers($this->lastId, $params['name']);
        array_push ($this->list, $producer);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['name']);
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['name']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Producers>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Producers>';
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Producers.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                $dataArr = array('name' => $data[0]);
                $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Producers.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}
