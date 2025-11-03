<?php
require_once '../BaseList.php';
require_once '../Producers.php';

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
}