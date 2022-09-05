<?php

/**
 * Abstract class for producing a response to HTTP request.
 * 
 * @author Alex Hakesley w16011419
 */

abstract class Response {
    protected $data;

    public function __construct() {
        $this->headers();

    }

    protected function headers() {
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }
}