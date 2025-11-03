<?php
abstract class BaseEntity{
    protected $id;
    public abstract function display();
}

class Producers extends BaseEntity{
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function display(){
        echo "Producer ID: {$this->id}, Name: {$this->name}</br>";
    }

    public function update($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function __destruct() {
        $this->id = null;
        $this->name = null;
    }
}

class Coffee_types extends BaseEntity{
    private $coffee_type;

    public function __construct($id, $coffee_type) {
        $this->id = $id;
        $this->coffee_type = $coffee_type;
    }

    public function display(){
        echo "Coffee type ID: {$this->id}, Coffee type: {$this->coffee_type}</br>";
    }

    public function update($id, $coffee_type) {
        $this->id = $id;
        $this->coffee_type = $coffee_type;
    }

    public function __destruct() {
        $this->id = null;
        $this->coffee_type = null;
    }
}

class Types extends BaseEntity{
    private $type;

    public function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    public function display(){
        echo "Type ID: {$this->id}, Type: {$this->type}</br>";
    }

    public function update($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    public function __destruct() {
        $this->id = null;
        $this->type = null;
    }
}

class Power_types extends BaseEntity{
    private $power_type;

    public function __construct($id, $power_type) {
        $this->id = $id;
        $this->power_type = $power_type;
    }

    public function display(){
        echo "Power type ID: {$this->id}, Power Type: {$this->power_type}</br>";
    }

    public function update($id, $power_type) {
        $this->id = $id;
        $this->power_type = $power_type;
    }

    public function __destruct() {
        $this->id = null;
        $this->power_type = null;
    }
}

class Coffee_machines extends BaseEntity{
    private $model;
    private $type_id;
    private $power_type_id;
    private $producer_id;
    private $coffee_type_id;

    public function __construct($id, $model, $type_id, $power_type_id, $producer_id, $coffee_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->type_id = $type_id;
        $this->power_type_id = $power_type_id;
        $this->producer_id = $producer_id;
        $this->coffee_type_id = $coffee_type_id;
    }

    public function display(){
        echo "Coffee Machine ID: {$this->id}, 
        Model: {$this->model}, Type ID: {$this->type_id}, Power Type ID: {$this->power_type_id},
         Producer ID: {$this->producer_id}, Coffee Type ID: {$this->coffee_type_id}</br>";
    }

    public function update($id, $model, $type_id, $power_type_id, $producer_id, $coffee_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->type_id = $type_id;
        $this->power_type_id = $power_type_id;
        $this->producer_id = $producer_id;
        $this->coffee_type_id = $coffee_type_id;
    }

    public function __destruct() {
        $this->id = null;
        $this->model = null;
        $this->type_id = null;
        $this->power_type_id = null;
        $this->producer_id = null;
        $this->coffee_type_id = null;
    }
}


$pr = new Producers(1, "Ardesto");
$pr->display();

$ct = new Coffee_types(1, "Мелена");
$ct->display();

$t = new Types(1, "Крапельна");
$t->display();

$pt = new Power_types(1, "Від мережі");
$pt->display();

$cm = new Coffee_machines(1, "YCM-D1200", 1, 1, 1, 1);
$cm->display();
?>