<?php
require_once '../BaseEntity.php';

class Coffee_types extends BaseEntity{
    private $coffee_type;

    public function __construct($id, $coffee_type) {
        $this->id = $id;
        $this->coffee_type = $coffee_type;
    }

    public function display(){
        echo "Coffee type ID: {$this->id}, Coffee type: {$this->coffee_type}</br>";
    }

    public function update($coffee_type) {
        $this->coffee_type = $coffee_type;
    }

    public function __destruct() {
        $this->id = null;
        $this->coffee_type = null;
    }

    public function getAsArray() {
        return [$this->coffee_type];
    }

    public function getAsAssArr() {
        return array('id' => $this->id, 'coffee_type' => $this->coffee_type);
    }

    public function getAsXML() {
        $xml = "<coffee_type>";
        $xml .= "<id>{$this->id}</id>";
        $xml .= "<coffee_type>{$this->coffee_type}</coffee_type>";
        $xml .= "</coffee_type>";
        return $xml;
    }
}