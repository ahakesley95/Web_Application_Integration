<?php

/**
 * Communicates directly with the readinglist db.
 * 
 * @author Alex Hakesley w16011419
 */

class ListGateway extends Gateway {
    public function __construct() {
        $this->setDatabase(READDB);
    }

    public function findAll($user_id) {
        $sql = "SELECT paper_id FROM readinglist WHERE user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function add($user_id, $paper_id) {
        $sql = "INSERT INTO readinglist (user_id, paper_id) VALUES (:user_id, :paper_id)";
        $params = [":user_id"=>$user_id, ":paper_id"=>$paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function remove($user_id, $paper_id) {
        $sql = "DELETE FROM readinglist WHERE user_id = :user_id AND paper_id = :paper_id";
        $params = [":user_id"=>$user_id, ":paper_id"=>$paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function removeAll($user_id) {
        $sql = "DELETE FROM readinglist WHERE user_id = :user_id";
        $params = [":user_id"=>$user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
    
}
