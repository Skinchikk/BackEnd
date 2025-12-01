<?php
require_once '../models/BaseList.php';
require_once '../models/Producers.php';

class ProducersList extends BaseList {
    public function add($params) {
        if(isset($params['id'])) {
            $this->lastId++;
        } else {
            $this->lastId++;
            $params['id'] = $this->lastId;
        }
        $producer = new Producers($params['id'], $params['name']);
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

    public function exportAsArray() {
        $result = array(['name']);
        foreach ($this->list as $item) {
            array_push($result, $item->getAsArray());
        }
        return $result;
    }

    public function exportAsXML() {
        $result = '<Producers>';
        foreach ($this->list as $item) {
            $result .= $item->getAsXML();
        }
        $result .= '</Producers>';
        return $result;
    }

    public function exportAsDDItems() {
        $result = '';
        foreach ($this->list as $item) {
            $itemData = $item->getAsAssArr();
            $result .= '<option value="'.$itemData['id'].'">'.$itemData['name'].'</option>';
        }
        return $result;
    }

    public function readFromFile() {
        $row = 0;
        if (($handle = fopen("../data/Producers.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row>0) {
                $dataArr = array('name' => $data[0]);
                $this->add($dataArr);
                }
                $row++;
            }
            fclose($handle);
        }
    }

    public function saveToFile() {
        $fp = fopen('../data/Producers.csv', 'w');
        foreach ($this->exportAsArray() as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }

    public function deleteFromDB($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM producers WHERE producer_id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return true;
    }

        public function addToDB($conn, $params) {
        $stmt = $conn->prepare("INSERT INTO producers VALUES (DEFAULT, ?)");
        $stmt->bind_param("s", $params['name']);
        $stmt->execute();
        return true;
    }

    public function updateDB($conn, $params) {
        $stmt = $conn->prepare("UPDATE producers SET producer_name=? WHERE producer_id=?");
        $stmt->bind_param("ss", $params['name'], $params['id']);
        $stmt->execute();
        return true;
    }

    public function getAllFromDB($conn) {
        $sql = "SELECT * FROM producers ORDER BY 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataArr = array('id' => $row['producer_id'], 'name' => $row['producer_name']);
                $this->add($dataArr);
            }
        }
    }
}
