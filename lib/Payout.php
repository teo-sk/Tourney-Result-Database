<?php

class Payout {
    private $db;
    private $tableName;
    private $id;
    private $place;
    private $amount;

    public function __construct($db, $tableName) {
        $this->db = $db;
        $this->tableName = $tableName;
    }

    public function getTableName(){
        return $this->tableName;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;

    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

    }

    public function getPlace() {
        return $this->place;
    }

    public function setPlace($place) {
        $this->place = $place;
    }

    public function getAmount() {
        return $this->amount;
    }
    
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getItem() {
        $this->db->where('id', $this->getId());
        $results = $this->db->get($this->getTableName());
        return $results;
    }

    public function setItem(){
        $insertData = array(
            'place' => $this->getPlace(),
            'amount' => $this->getAmount()
        );
        $this->db->insert($this->getTableName(), $insertData);
    }

}

?>