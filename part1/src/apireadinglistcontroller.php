<?php

/**
 * Controls the gateway to the Reading List (api/readinglist) endpoint.
 * 
 * Requires a valid JWT token in the 'token' parameter. Performs add, remove
 * and remove all operations on records in the readinglist db where
 * readinglist.user_id equals the 'user_id' parameter.
 * 
 * @author Alex Hakesley w16011419
 */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiReadinglistController extends Controller {

    protected function setGateway() {
        $this->gateway = new ListGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $add = $this->getRequest()->getParameter("add");
        $remove = $this->getRequest()->getParameter("remove");
        $removeAll = $this->getRequest()->getParameter("removeAll");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                try {
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                    $user_id = $decoded->user_id;
                    if (!is_null($add)) {
                        $this->getGateway()->add($user_id, $add);
                    } elseif (!is_null($remove)) {
                        $this->getGateway()->remove($user_id, $remove);
                    } elseif (!is_null($removeAll)) {
                        $this->getGateway()->removeAll($user_id);
                    } else {
                        $this->getGateway()->findAll($user_id);
                    }
                } catch (Exception $e) {
                    $this->getResponse()->setMessage("Unauthorized");
                    $this->getResponse()->setStatusCode(401);
                }
            } else {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }
        
        return $this->getGateway()->getResult();
    }
}