<?php

/**
 * Communicates directly with the author table of the dis db. 
 * 
 * @author Alex Hakesley w16011419
 */

class AuthorGateway extends Gateway {

    private $coreStatement = "SELECT author_id, last_name, first_name FROM author";

    public function __construct(){
        $this->setDatabase(DISDB);
    }

    public function findAll() {             
        $sql = $this->coreStatement . " ORDER BY first_name";       
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }

    public function findById($id) {
        $sql = $this->coreStatement . " WHERE author_id = :id ORDER BY first_name, last_name";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}