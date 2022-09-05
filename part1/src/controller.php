<?php

/**
 * Abstract class for controlling a given gateway.
 * 
 * @author Alex Hakesley w16011419
 */

abstract class Controller {
    private $request;
    private $response;
    protected $gateway;

    public function __construct($request, $response) {
        $this->setGateway();
        $this->setRequest($request);
        $this->setResponse($response);

        $data = $this->processRequest();
        $this->getResponse()->setData($data);
    }

    private function setRequest($request) {
        $this->request = $request;
    }

    protected function getRequest() {
        return $this->request;
    }

    private function setResponse($response) {
        $this->response = $response;
    }

    protected function getResponse() {
        return $this->response;
    }

    protected function setGateway() {

    }

    protected function getGateway() {
        return $this->gateway;
    }

    protected function processRequest() {

    }

}