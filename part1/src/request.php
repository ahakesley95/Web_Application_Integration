<?php

/**
 * Abstract class for handling an HTTP request.
 * 
 * @author Alex Hakesley w16011419
 */

class Request {
    private $basepath = BASEPATH;
    private $path = "";
    private $requestMethod;

    public function __construct() {
        $this->setPath($this->basepath);
    }

    private function requestURI() {
        return $_SERVER['REQUEST_URI'];
    }

    private function setPath($basepath) {
        $this->path = parse_url($this->requestURI())['path'];
        $this->path = str_replace($basepath, "", $this->path);
        $this->path = strtolower(trim($this->path, "/"));
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
    }

    public function getPath() {
        return $this->path;
    }

    public function getRequestMethod() {
        return $this->requestMethod;
    }

    public function getParameter($param) {
        if ($this->getRequestMethod() === "GET") {
            $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        } elseif ($this->getRequestMethod() === "POST") {
            $param =  filter_input(INPUT_POST, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $param;
    }





}