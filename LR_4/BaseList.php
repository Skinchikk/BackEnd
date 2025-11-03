<?php
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

    public function exportAsJSON() {
        $result = array();
        foreach ($this->list as $item) {
            array_push($result, $item->getAsAssArr());
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}