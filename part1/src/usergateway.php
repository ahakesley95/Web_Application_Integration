<?php

/**
 * Communicates directly with the user db.
 * 
 * @author Alex Hakesley w16011419
 */

class UserGateway extends Gateway {

    public function __construct() {
        $this->setDatabase(USERDB);
    }

    public function findPassword($email) {
        $sql = "SELECT id, password FROM user WHERE email = :email";
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}