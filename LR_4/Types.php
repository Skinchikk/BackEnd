<?php 
require_once '../BaseEntity.php';

class Types extends BaseEntity{
    private $type;

    public function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    public function display(){
        echo "Type ID: {$this->id}, Type: {$this->type}</br>";
    }

    public function update($type) {
        $this->type = $type;
    }

    public function __destruct() {
        $this->id = null;
        $this->type = null;
    }

    public function getAsArray() {
        return [$this->type];
    }

    public function getAsAssArr() {
        return array('id' => $this->id, 'type' => $this->type);
    }

    public function getAsXML() {
        $xml = "<type>";
        $xml .= "<id>{$this->id}</id>";
        $xml .= "<type>{$this->type}</type>";
        $xml .= "</type>";
        return $xml;
    }
}