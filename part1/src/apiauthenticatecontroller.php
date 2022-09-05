<?php

/**
 * Controls the gateway to the Authenticate (api/authenticate) endpoint.
 * 
 * Gets the 'email' and 'password' parameters from the request and,
 * if both valid, returns a JWT.
 * 
 * @author Alex Hakesley w16011419
 */

use Firebase\JWT\JWT;

class ApiAuthenticateController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    protected function processRequest() {
        $data = [];

        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");

        
        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($email) && !is_null($password)) {
                $this->getGateway()->findPassword($email);
                if (count($this->getGateway()->getResult()) == 1) {
                    $hashpassword = $this->getGateway()->getResult()[0]['password'];
                    if (password_verify($password, $hashpassword)) {
                        $key = SECRET_KEY;
                        $payload = array(
                            "user_id" => $this->getGateway()->getResult()[0]['id'],
                            "exp" => time() + 7776000
                        );
                        $jwt = JWT::encode($payload, $key, 'HS256');
                        $data = ['token'=>$jwt];
                    }
                }
            } 
            if (!array_key_exists('token', $data)) {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $data;
    }
}