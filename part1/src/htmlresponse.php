<?php

/**
 * A response with HTML content.
 * 
 * @author Alex Hakesley w16011419
 */

class HTMLResponse extends Response {
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }
}