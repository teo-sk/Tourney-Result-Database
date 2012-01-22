<?php

class Model_Tourney extends Model {
    private $title;
    private $entrants;
    private $buy_in;
    private $payouts;


    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getEntrants() {
        return $this->entrants;
    }

    public function setEntrants($entrants) {
        $this->entrants = $entrants;
    }

    public function getBuyIn() {
        return $this->buy_in;
    }

    public function setBuyIn($buy_in) {
        $this->buy_in = $buy_in;
    }

    private function getPayouts () {
        return $this->payouts;
    }

    public function addPayout(Model_Payout $payout) {
        $this->payouts[] = $payout;
    }

    public function setItem(){
        $insertData = array(
            'title' => $this->getTitle(),
            'entrants' => $this->getEntrants(),
            'buy_in' => $this->getBuyIn()
        );
        $this->getDb()->insert($this->getTableName(), $insertData);
        $this->setId($this->getDb()->getInsertId());
        $this->setTourneyPayouts();
    }

    public function getItem(){
        $result = parent::getItem();
        $result['payouts'] = $this->fetchTourneyPayouts($this->getId());
        return $result;
    }

    public function listItems(){
        $results = parent::listItems();
        foreach ($results as $i => $result) {
            $results[$i]['payouts'] = $this->fetchTourneyPayouts($result['id']);
        }
        return $results;        
    }

    private function setTourneyPayouts(){
        foreach ($this->getPayouts() as $payout) {
            $insertData = array(
                'payout' => $payout->getId(),
                'tourney' => $this->getId()
            );
            $this->getDb()->insert('tourney_payouts', $insertData);
        }
    }

    private function fetchTourneyPayouts($tourneyId){
        $params = array($tourneyId);
        $resutls = $this->getDb()->rawQuery("
        SELECT p.id, p.place, p.amount FROM payouts p 
        LEFT JOIN tourney_payouts tp ON p.id = tp.payout
        LEFT JOIN tourneys t ON tp.tourney = t.id
        WHERE t.id = ?
        ", $params);
        return $resutls;
    }
}

?>