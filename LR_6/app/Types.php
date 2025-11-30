<?php 
require_once '../app/BaseEntity.php';

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

    public function getAsTableRow() {
        $tr = "<tr>";
        $tr .= "<td>{$this->id}</td>";
        $tr .= "<td>{$this->type}</td>";
        $tr .= "<td><a href='AddType.php?id=".$this->id."'>Edit</a><a href='Types-List.php?action=delete&id=".$this->id."'>Delete</a></td>";
        $tr .= "</tr>";
        return $tr;
    }
}