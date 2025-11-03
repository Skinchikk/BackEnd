<?php
require_once '../BaseList.php';
require_once '../Power_types.php';

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
}