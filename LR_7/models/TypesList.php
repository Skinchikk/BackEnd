<?php
require_once '../models/BaseList.php';
require_once '../models/Types.php';

class TypesList extends BaseList {
    public function add($params) {
        if(isset($params['id'])) {
            $this->lastId++;
        } else {
            $this->lastId++;
            $params['id'] = $this->lastId;
        }
        $type = new Types($params['id'], $params['type']);
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

    public function exportAsArray() {
        $result = array(['type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Types>';
        return $result;
    }

    public function exportAsDDItems() {
        $result = '';
        foreach ($this->list as $item) {
            $itemData = $item->getAsAssArr();
            $result .= '<option value="'.$itemData['id'].'">'.$itemData['type'].'</option>';
        }
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function deleteFromDB($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM types WHERE type_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return true;
    }

        public function addToDB($conn, $params) {
        $stmt = $conn->prepare("INSERT INTO types VALUES (DEFAULT, ?)");
        $stmt->bind_param("s", $params['type']);
        $stmt->execute();
        return true;
    }

    public function updateDB($conn, $params) {
        $stmt = $conn->prepare("UPDATE types SET type_name=? WHERE type_id=?");
        $stmt->bind_param("ss", $params['type'], $params['id']);
        $stmt->execute();
        return true;
    }

    public function getAllFromDB($conn) {
        $sql = "SELECT * FROM types ORDER BY 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataArr = array('id' => $row['type_id'], 'type' => $row['type_name']);
                $this->add($dataArr);
            }
        }
    }
}