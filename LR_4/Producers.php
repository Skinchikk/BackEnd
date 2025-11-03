<?php
require_once '../BaseEntity.php';

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
}