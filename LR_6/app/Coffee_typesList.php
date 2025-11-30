<?php
require_once '../app/BaseList.php';
require_once '../app/Coffee_types.php';

class Coffee_typesList extends BaseList {
    public function add($params) {
        if(isset($params['id'])) {
            $this->lastId++;
        } else {
            $this->lastId++;
            $params['id'] = $this->lastId;
        }
        $coffee_type = new Coffee_types($params['id'], $params['coffee_type']);
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

    public function exportAsArray() {
        $result = array(['coffee_type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Coffee_types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Coffee_types>';
        return $result;
    }

    public function exportAsDDItems() {
        $result = '';
        foreach ($this->list as $item) {
            $itemData = $item->getAsAssArr();
            $result .= '<option value="'.$itemData['id'].'">'.$itemData['coffee_type'].'</option>';
        }
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Coffee_types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('coffee_type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Coffee_types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function deleteFromDB($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM coffee_types WHERE coffee_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return true;
    }

        public function addToDB($conn, $params) {
        $stmt = $conn->prepare("INSERT INTO coffee_types VALUES (DEFAULT, ?)");
        $stmt->bind_param("s", $params['coffee_type']);
        $stmt->execute();
        return true;
    }

    public function updateDB($conn, $params) {
        $stmt = $conn->prepare("UPDATE coffee_types SET coffee_name=? WHERE coffee_id=?");
        $stmt->bind_param("ss", $params['coffee_type'], $params['id']);
        $stmt->execute();
        return true;
    }

    public function getAllFromDB($conn) {
        $sql = "SELECT * FROM coffee_types ORDER BY 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataArr = array('id' => $row['coffee_id'], 'coffee_type' => $row['coffee_name']);
                $this->add($dataArr);
            }
        }
    }
}