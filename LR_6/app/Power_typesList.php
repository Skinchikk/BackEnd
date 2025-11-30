<?php
require_once '../app/BaseList.php';
require_once '../app/Power_types.php';

class Power_typesList extends BaseList {
    public function add($params) {
        if(isset($params['id'])) {
            $this->lastId++;
        } else {
            $this->lastId++;
            $params['id'] = $this->lastId;
        }
        $power_type = new Power_types($params['id'], $params['power_type']);
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

    public function exportAsArray() {
        $result = array(['power_type']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Power_types>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Power_types>';
        return $result;
    }

    public function exportAsDDItems() {
        $result = '';
        foreach ($this->list as $item) {
            $itemData = $item->getAsAssArr();
            $result .= '<option value="'.$itemData['id'].'">'.$itemData['power_type'].'</option>';
        }
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Power_types.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                    $dataArr = array('power_type' => $data[0]);
                    $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Power_types.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function deleteFromDB($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM power_types WHERE power_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return true;
    }

        public function addToDB($conn, $params) {
        $stmt = $conn->prepare("INSERT INTO power_types VALUES (DEFAULT, ?)");
        $stmt->bind_param("s", $params['power_type']);
        $stmt->execute();
        return true;
    }

    public function updateDB($conn, $params) {
        $stmt = $conn->prepare("UPDATE power_types SET power_name=? WHERE power_id=?");
        $stmt->bind_param("ss", $params['power_type'], $params['id']);
        $stmt->execute();
        return true;
    }

    public function getAllFromDB($conn) {
        $sql = "SELECT * FROM power_types ORDER BY 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataArr = array('id' => $row['power_id'], 'power_type' => $row['power_name']);
                $this->add($dataArr);
            }
        }
    }
}