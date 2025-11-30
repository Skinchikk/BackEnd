<?php 
require_once '../app/BaseEntity.php';

class Coffee_machines extends BaseEntity{
    private $model;
    private $type_id;
    private $coffee_type_id;
    private $producer_id;
    private $power_type_id;

    public function __construct($id, $model, $producer_id, $type_id, $coffee_type_id, $power_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->producer_id = $producer_id;
        $this->type_id = $type_id;
        $this->coffee_type_id = $coffee_type_id;
        $this->power_type_id = $power_type_id;
    }

    public function display(){
        echo "Coffee machine ID: {$this->id}, Model: {$this->model},  Producer ID: {$this->producer_id},
        Type ID: {$this->type_id}, Coffee Type ID: {$this->coffee_type_id},  Power type ID: {$this->power_type_id}</br>";
    }

    public function update($id, $model, $producer_id, $type_id, $coffee_type_id, $power_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->producer_id = $producer_id;
        $this->type_id = $type_id;
        $this->coffee_type_id = $coffee_type_id;
        $this->power_type_id = $power_type_id;
    }

    public function __destruct() {
        $this->id = null;
        $this->model = null;
        $this->type_id = null;
        $this->coffee_type_id = null;
        $this->producer_id = null;
        $this->power_type_id = null;
    }

    public function getAsArray() {
        return [$this->id, $this->model, $this->producer_id, $this->type_id, $this->coffee_type_id, $this->power_type_id];
    }

    public function getAsAssArr() {
        return array(
            'id' => $this->id,
            'model' => $this->model,
            'producer_id' => $this->producer_id,
            'type_id' => $this->type_id,
            'coffee_type_id' => $this->coffee_type_id,
            'power_type_id' => $this->power_type_id
        );
    }

    public function getAsXML() {
        $xml = "<coffee_machine>";
        $xml .= "<id>{$this->id}</id>";
        $xml .= "<model>{$this->model}</model>";
        $xml .= "<producer_id>{$this->producer_id}</producer_id>";
        $xml .= "<type_id>{$this->type_id}</type_id>";
        $xml .= "<coffee_type_id>{$this->coffee_type_id}</coffee_type_id>";
        $xml .= "<power_type_id>{$this->power_type_id}</power_type_id>";
        $xml .= "</coffee_machine>";
        return $xml;
    }

        public function getAsTableRow() {
        $tr = "<tr>";
        $tr .= "<td>{$this->id}</td>";
        $tr .= "<td>{$this->model}</td>";
        $tr .= "<td>{$this->producer_id}</td>";
        $tr .= "<td>{$this->type_id}</td>";
        $tr .= "<td>{$this->coffee_type_id}</td>";
        $tr .= "<td>{$this->power_type_id}</td>";
        $tr .= "<td><a href='AddCoffeeMachine.php?id=".$this->id."'>Edit</a><a href='CoffeeMachines-List.php?action=delete&id=".$this->id."'>Delete</a></td>";
        $tr .= "</tr>";
        return $tr;
    }
}