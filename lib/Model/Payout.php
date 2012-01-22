<?php

class Model_Payout extends Model {
    private $place;
    private $amount;

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

    public function setItem(){
        $insertData = array(
            'place' => $this->getPlace(),
            'amount' => $this->getAmount()
        );
        $this->getDb()->insert($this->getTableName(), $insertData);
        $this->setId($this->getDb()->getInsertId());
    }

}

?>