<?php
abstract class BaseEntity{
    protected $id;
    public abstract function display();
    public function getId(){
        return $this->id;
    }
}