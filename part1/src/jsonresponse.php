<?php

/**
 * A response in JSON format.
 * 
 * @author Alex Hakesley w16011419
 */

class JSONResponse extends Response {

    private $message;
    private $statusCode;

    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getData(){
        if (is_null($this->message)) {
            if (!is_null($this->data) && count($this->data) > 0) {
                $this->setMessage("OK");
                $this->setStatusCode(200);
            } else {
                $this->setMessage("No content");
                $this->setStatusCode(204);
            }
        } 
        $response['message'] = $this->message;
        $response['statusCode'] = $this->statusCode;
        $response['count'] = (is_null($this->data)) ? 0 : count($this->data);
        $response['results'] = $this->data;

        http_response_code($this->statusCode);

        return json_encode($response);
    }
}