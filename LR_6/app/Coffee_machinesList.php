<?php
require_once '../app/BaseList.php';
require_once '../app/Coffee_machines.php';

class Coffee_machinesList extends BaseList {
    public function add($params) {
        if(isset($params['id'])) {
            $this->lastId++;
        } else {
            $this->lastId++;
            $params['id'] = $this->lastId;
        }
        $coffee_machine = new Coffee_machines(
            $params['id'],
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

    public function deleteFromDB($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM coffee_machines WHERE machine_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return true;
    }

    public function addToDB($conn, $params) {
       $stmt = $conn->prepare("INSERT INTO coffee_machines (model, producer_id, type_id, coffee_id, power_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiii", $params['model'], $params['producer_id'], $params['type_id'], $params['coffee_type_id'], $params['power_type_id']);
        $stmt->execute();
        return true;
    }

    public function updateDB($conn, $params) {
        $stmt = $conn->prepare("UPDATE coffee_machines SET model=?, producer_id=?, type_id=?, coffee_id=?, power_id=? WHERE machine_id=?");
        $stmt->bind_param("siiiii", $params['model'], $params['producer_id'], $params['type_id'], $params['coffee_type_id'], $params['power_type_id'], $params['id']);
        $stmt->execute();
        return true;
    }

    public function getAllFromDB($conn) {
        $sql = "SELECT m.machine_id, m.model, p.producer_name, t.type_name, c.coffee_name, pt.power_name 
                FROM coffee_machines m, producers p, types t, coffee_types c, power_types pt
                WHERE m.producer_id = p.producer_id 
                AND m.type_id = t.type_id 
                AND m.coffee_id = c.coffee_id 
                AND m.power_id = pt.power_id
                ORDER BY 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataArr = array(
                    'id'             => $row['machine_id'],
                    'model'          => $row['model'],
                    'producer_id'    => $row['producer_name'],
                    'type_id'        => $row['type_name'],
                    'coffee_type_id' => $row['coffee_name'],
                    'power_type_id'  => $row['power_name']
                );
                $this->add($dataArr);
            }
        }
    }
}
?>