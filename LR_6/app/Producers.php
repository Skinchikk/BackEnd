<?php
require_once '../app/BaseEntity.php';

class Producers extends BaseEntity{
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function display(){
        echo "Producer ID: {$this->id}, Name: {$this->name}</br>";
    }

    public function update($name) {
        $this->name = $name;
    }

    public function __destruct() {
        $this->id = null;
        $this->name = null;
    }

    public function getAsArray() {
        return [$this->name];
    }

    public function getAsAssArr() {
        return array('id' => $this->id, 'name' => $this->name);
    }

    public function getAsXML() {
        $xml = "<producer>";
        $xml .= "<id>{$this->id}</id>";
        $xml .= "<name>{$this->name}</name>";
        $xml .= "</producer>";
        return $xml;
    }

    public function getAsTableRow() {
        $tr = "<tr>";
        $tr .= "<td>{$this->id}</td>";
        $tr .= "<td>{$this->name}</td>";
        $tr .= "<td><a href='AddProducer.php?id=".$this->id."'>Edit</a><a href='Producers-List.php?action=delete&id=".$this->id."'>Delete</a></td>";
        $tr .= "</tr>";
        return $tr;
    }
}