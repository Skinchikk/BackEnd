<?php
require_once '../BaseList.php';
require_once '../Types.php';

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
}