<?php

/**
 * Interface used for descendants of the Webpage class.
 * 
 * @author Alex Hakesley w16011419
 */

interface IWebpage {

    public function __construct($title, $links, $activePage, $heading1);

    public function addParagraph($text);

    public function generateWebpage();
}