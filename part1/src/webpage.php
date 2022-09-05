<?php
/**
 * Generate a webpage
 * 
 * @author Alex Hakesley w16011419
 * 
 */

abstract class Webpage implements IWebpage
{
    private $head = "";
    private $body = "";
    private $foot = "";

    public function __construct($title, $links, $activePage, $heading1) {
        $this->setHead($title);
        $this->addMenu($links, $activePage);
        $this->addHeading1($heading1);
        $this->setFoot();
    }

    protected function setHead($title) {
        $this->head = webpageComponents::webpageHead($title);
    }

    private function getHead() {
        return $this->head;
    }

    protected function setBody($text) {
        $this->body .= $text;
    }

    private function getBody() {
        return $this->body;
    }

    protected function setFoot() {
        $this->foot = WebpageComponents::webpageFoot();
    }

    private function getFoot() {
        return $this->foot;
    }

    protected function addMenu($links, $activePage) {
        $menu = WebpageComponents::menu($links, $activePage);
        $this->setBody($menu);
    }

    protected function addHeading1($text) {
        $this->setBody("<h1>$text</h1>");
    }

    public function addHeading2($text) {
        $this->setBody("<h2>$text</h2>");
    }

    public function addParagraph($text) {
        $this->setBody("<p>$text</p>");
    }

    public function generateWebpage() {
        return $this->getHead() . $this->getBody() .  $this->getFoot();
    }


}