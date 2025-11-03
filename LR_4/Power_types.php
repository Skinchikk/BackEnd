<?php 
require_once '../BaseEntity.php';

class Power_types extends BaseEntity{
    private $power_type;

    public function __construct($id, $power_type) {
        $this->id = $id;
        $this->power_type = $power_type;
    }

    public function display(){
        echo "Power type ID: {$this->id}, Power type: {$this->power_type}</br>";
    }

    public function update($power_type) {
        $this->power_type = $power_type;
    }

    public function __destruct() {
        $this->id = null;
        $this->power_type = null;
    }

    public function getAsArray() {
        return [$this->power_type];
    }

    public function getAsAssArr() {
        return array('id' => $this->id, 'power_type' => $this->power_type);
    }

    public function getAsXML() {
        $xml = "<power_type>";
        $xml .= "<id>{$this->id}</id>";
        $xml .= "<power_type>{$this->power_type}</power_type>";
        $xml .= "</power_type>";
        return $xml;
    }
}