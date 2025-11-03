<?php
require_once '../BaseList.php';
require_once '../Coffee_machines.php';

class Coffee_machinesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $coffee_machine = new Coffee_machines(
            $this->lastId,
            $params['model'],
            $params['producer'],
            $params['type'],
            $params['coffee_type'],
            $params['power_type']

        );
        array_push ($this->list, $coffee_machine);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update(
                    $params['model'],
                    $params['producer'],
                    $params['type'],
                    $params['coffee_type'],
                    $params['power_type']
                );
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['model', 'producer', 'type', 'coffee_type', 'power_type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Coffee_machines>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Coffee_machines>';
        return $result;
    }
}