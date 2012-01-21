<?php

Class Model {
    private $db;
    private $tableName;
    private $id;    

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

    public function getItem() {
        $this->db->where('id', $this->getId());
        $results = $this->db->get($this->getTableName());
        return $results;
    }

}

?>