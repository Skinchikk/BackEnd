<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

abstract class BaseEntity{
    protected $id;
    public abstract function display();
    public function getId(){
        return $this->id;
    }
}

abstract class BaseList {
    protected $list;
    protected $lastId;
    public function __construct() {
        $this->list = [];
        $this->lastId = 0;
    }
    public abstract function add($params);
    public function display(){
    for ($i=0; $i<count($this->list);$i++){
            $this->list[$i]->display();
        }
    }
    public abstract function update($params);
    public function delete($id){
        for ($i=0; $i<count($this->list);$i++){
            if($id==$this->list[$i]->getId()){
                array_splice($this->list, $i, 1);
                break;
            }
        }
    }
}

class ProducersList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $producer = new Producers($this->lastId, $params['name']);
        array_push ($this->list, $producer);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['name']);
                break;
            }
        }
    }
}

class Coffee_typesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $coffee_type = new Coffee_types($this->lastId, $params['coffee_type']);
        array_push ($this->list, $coffee_type);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['coffee_type']);
                break;
            }
        }
    }
}

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
}

class Power_typesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $power_type = new Power_types($this->lastId, $params['power_type']);
        array_push ($this->list, $power_type);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update($params['power_type']);
                break;
            }
        }
    }
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

    public function update($name) {
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

    public function update($coffee_type) {
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

    public function update($type) {
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
        echo "Power type ID: {$this->id}, Power type: {$this->power_type}</br>";
    }

    public function update($power_type) {
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
    private $coffee_type_id;
    private $producer_id;
    private $power_type_id;

    public function __construct($id, $model, $type_id, $coffee_type_id, $producer_id, $power_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->type_id = $type_id;
        $this->coffee_type_id = $coffee_type_id;
        $this->producer_id = $producer_id;
        $this->power_type_id = $power_type_id;
    }

    public function display(){
        echo "Coffee machine ID: {$this->id}, Model: {$this->model}, Type ID: {$this->type_id}, 
        Coffee Type ID: {$this->coffee_type_id}, Producer ID: {$this->producer_id}, Power type ID: {$this->power_type_id}</br>";
    }

    public function update($id, $model, $type_id, $coffee_type_id, $producer_id, $power_type_id) {
        $this->id = $id;
        $this->model = $model;
        $this->type_id = $type_id;
        $this->coffee_type_id = $coffee_type_id;
        $this->producer_id = $producer_id;
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
}
// === Приклад використання ===

// Створення списків
$producersList = new ProducersList();
$coffeeTypesList = new Coffee_typesList();
$typesList = new TypesList();
$powerTypesList = new Power_typesList();

// Додавання елементів
$producersList->add(['name' => 'Ardesto']);
$producersList->add(['name' => 'DeLonghi']);

$coffeeTypesList->add(['coffee_type' => 'Мелена']);
$coffeeTypesList->add(['coffee_type' => 'Цільнозернова']);

$typesList->add(['type' => 'Крапельна']);
$typesList->add(['type' => 'Автоматична']);

$powerTypesList->add(['power_type' => 'Від мережі']);
$powerTypesList->add(['power_type' => 'Від нагрівання']);

// Відображення списків
echo "<b>Producers:</b><br>";
$producersList->display();

echo "<b>Coffee Types:</b><br>";
$coffeeTypesList->display();

echo "<b>Types:</b><br>";
$typesList->display();

echo "<b>Power Types:</b><br>";
$powerTypesList->display();

// Оновлення елементів
$producersList->update(['id' => 1, 'name' => 'Beko']);
$coffeeTypesList->update(['id' => 2, 'coffee_type' => 'В капсулах']);
$typesList->update(['id' => 1, 'type' => 'Гейзерна']);
$powerTypesList->update(['id' => 2, 'power_type' => 'Від акумулятора']);

// Відображення після оновлення
echo "<b>After update:</b><br>";
$producersList->display();
$coffeeTypesList->display();
$typesList->display();
$powerTypesList->display();

// Видалення елементів
$producersList->delete(2);
$coffeeTypesList->delete(1);
$typesList->delete(2);
$powerTypesList->delete(1);

// Відображення після видалення
echo "<b>After delete:</b><br>";
$producersList->display();
$coffeeTypesList->display();
$typesList->display();
$powerTypesList->display();

// Створення та використання Coffee_machines
$coffeeMachine = new Coffee_machines(
    1,
    'YCM-D1200',
    1, // type_id
    2, // coffee_type_id
    1, // producer_id
    2  // power_type_id
);

echo "<b>Coffee Machine:</b><br>";
$coffeeMachine->display();

// Оновлення Coffee_machines
$coffeeMachine->update(
    1,
    'YCM-E1500',
    1,
    2,
    1,
    2
);

echo "<b>Coffee Machine after update:</b><br>";
$coffeeMachine->display();