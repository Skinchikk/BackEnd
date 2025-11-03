<?php
require_once '../BaseList.php';
require_once '../Coffee_types.php';

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
}