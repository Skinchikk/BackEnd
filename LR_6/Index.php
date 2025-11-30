<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './ProducersList.php';
require_once './Coffee_typesList.php';
require_once './TypesList.php';
require_once './Power_typesList.php';
require_once './Coffee_machinesList.php';

$tl = new TypesList();
$row = 0;
if (($handle = fopen("./data/Types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('type' => $data[0]);
            $tl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
$tl -> display();

$ctl = new Coffee_typesList();
$row = 0;
if (($handle = fopen("./data/Coffee_types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('coffee_type' => $data[0]);
            $ctl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
$ctl -> display();

$ptl = new Power_typesList();
$row = 0;
if (($handle = fopen("./data/Power_types.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('power_type' => $data[0]);
            $ptl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
$ptl -> display();

$pl = new ProducersList();
$row = 0;
if (($handle = fopen("./data/Producers.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array('name' => $data[0]);
            $pl->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
$pl -> display();

$cml = new Coffee_machinesList();
$row = 0;
if (($handle = fopen("./data/Coffee_machines.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row>0) {
            $dataArr = array(
                'model' => $data[0],
                'producer' => $data[1],
                'type' => $data[2],
                'coffee_type' => $data[3],
                'power_type' => $data[4]);
            $cml->add($dataArr);
        }
        $row++;
    }
    fclose($handle);
}
$cml -> display();


/*$fp = fopen('./data/Producers.csv', 'w');
var_dump($pl->exportAsArray());
foreach ($pl->exportAsArray() as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

$fp = fopen('./data/Types.csv', 'w');
foreach ($tl->exportAsArray() as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

$fp = fopen('./data/Coffee_types.csv', 'w');
foreach ($ctl->exportAsArray() as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

$fp = fopen('./data/Power_types.csv', 'w');
foreach ($ptl->exportAsArray() as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

$fp = fopen('./data/Coffee_machines.csv', 'w');
foreach ($cml->exportAsArray() as $row) {
    fputcsv($fp, $row);
}

fclose($fp);*/






/*$producersList = new ProducersList();
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
$coffeeMachine->display(); */