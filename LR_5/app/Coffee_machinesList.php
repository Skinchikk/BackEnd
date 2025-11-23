<?php
require_once '../app/BaseList.php';
require_once '../app/Coffee_machines.php';

class Coffee_machinesList extends BaseList {
    public function add($params) {
        $this->lastId++;
        $coffee_machine = new Coffee_machines(
            $this->lastId,
            $params['model'],
            $params['producer_id'],
            $params['type_id'],
            $params['coffee_type_id'],
            $params['power_type_id']

        );
        array_push ($this->list, $coffee_machine);
    }

    public function update($params) {
         for ($i=0; $i<count($this->list);$i++){
            if($params['id']==$this->list[$i]->getId()){
                $this->list[$i]->update(
                    $params['id'],
                    $params['model'],
                    $params['producer_id'],
                    $params['type_id'],
                    $params['coffee_type_id'],
                    $params['power_type_id']
                );
                break;
            }
        }
    }

    public function exportAsArray() {
        $result = array(['model', 'producer_id', 'type_id', 'coffee_type_id', 'power_type_id']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Coffee_machines>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Coffee_machines>';
        return $result;
    }

    public function readFromFile() {
        $this->list = [];
        $row = 0;
        if (($handle = fopen("../data/Coffee_machines.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row === 0) {
                    $row++;
                    continue;
                }
                if (count($data) < 5) continue;
                $dataArr = array(
                    'model'          => $data[0],
                    'producer_id'    => $data[1],
                    'type_id'        => $data[2],
                    'coffee_type_id' => $data[3],
                    'power_type_id'  => $data[4]
                );
                $this->add($dataArr);
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Coffee_machines.csv', 'w');
        fputcsv($fp, ['model','producer_id','type_id','coffee_type_id','power_type_id']);

        foreach ($this->list as $item) {
            if (method_exists($item, 'getAsArray')) {

                $row = $item->getAsArray();

                array_shift($row);

                fputcsv($fp, $row);
            }
        }

        fclose($fp);
    }


    /*public function readFromFile() {
        $this->list = [];
        $this->lastId = 0;
        $row = 0;
        $hasHeader = false;
        $header = [];

        $file = __DIR__ . '/../data/Coffee_machines.csv';
        if (!file_exists($file)) return;

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row === 0) {
                    // визначаємо, чи перший рядок — заголовок
                    $possibleHeader = array_map('trim', $data);
                    if (in_array('model', $possibleHeader) && (in_array('producer_id', $possibleHeader) || in_array('type_id', $possibleHeader))) {
                        $hasHeader = true;
                        $header = $possibleHeader;
                        $row++;
                        continue;
                    } else {
                        // немає заголовку — обробляємо як дані
                        $hasHeader = false;
                    }
                }

                if ($hasHeader) {
                    // якщо є заголовок — мапимо значення за назвою колонок
                    $assoc = [];
                    foreach ($header as $i => $colName) {
                        $assoc[$colName] = isset($data[$i]) ? $data[$i] : '';
                    }
                    // Якщо у файлі був стовпець id — використаємо його як внутрішній id,
                    // інакше присвоїмо новий
                    if (isset($assoc['id']) && $assoc['id'] !== '') {
                        $id = (int)$assoc['id'];
                    } else {
                        $id = ++$this->lastId;
                    }
                    // Створюємо об'єкт (constructor: id, model, producer_id, type_id, coffee_type_id, power_type_id)
                    $cm = new Coffee_machines(
                        $id,
                        $assoc['model'] ?? '',
                        $assoc['producer_id'] ?? '',
                        $assoc['type_id'] ?? '',
                        $assoc['coffee_type_id'] ?? '',
                        $assoc['power_type_id'] ?? ''
                    );
                    $this->list[] = $cm;
                    if ($id > $this->lastId) $this->lastId = $id;
                } else {
                    // формат без заголовка: model,producer_id,type_id,coffee_type_id,power_type_id
                    $model = $data[0] ?? '';
                    $producer_id = $data[1] ?? '';
                    $type_id = $data[2] ?? '';
                    $coffee_type_id = $data[3] ?? '';
                    $power_type_id = $data[4] ?? '';

                    $id = ++$this->lastId;
                    $cm = new Coffee_machines($id, $model, $producer_id, $type_id, $coffee_type_id, $power_type_id);
                    $this->list[] = $cm;
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $file = __DIR__ . '/../data/Coffee_machines.csv';
        $dir = dirname($file);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $h = fopen($file, 'w');
        if ($h === false) return false;

        // заголовок БЕЗ id
        $header = ['model','producer_id','type_id','coffee_type_id','power_type_id'];
        fputcsv($h, $header);

        // беремо масив з об'єкта та обрізаємо перший елемент (id)
        foreach ($this->list as $item) {
            if (method_exists($item, 'getAsArray')) {
                $arr = $item->getAsArray(); // [id, model, producer_id, type_id, coffee_type_id, power_type_id]
                // видаляємо id
                array_shift($arr);
                // тепер $arr порядок співпадає з $header
                fputcsv($h, $arr);
            } else {
                // fallback: пустий рядок у фіксованому форматі
                fputcsv($h, ['', '', '', '', '']);
            }
        }

        fclose($h);
        return true;
    }




    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Coffee_machines.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array(
                        'model' => $data[0],
                        'producer_id' => $data[1],
                        'type_id' => $data[2],
                        'coffee_type_id' => $data[3],
                        'power_type_id' => $data[4]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Coffee_machines.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    } */
} 