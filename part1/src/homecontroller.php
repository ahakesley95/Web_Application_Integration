<?php

/**
 * Controls the contents and generation of the Home page.
 * 
 * @author Alex Hakesley w16011419
 */

class HomeController extends Controller {

    protected function processRequest() {
        $links = ["Home"=>"home",
          "Documentation"=>"documentation"];
        $page = new Homepage("Homepage", $links, "home", "Home");
        $page->addParagraph("This website is a product of work done for part 1 of coursework for KF6012 Web Application Integration at Northumbria University.");
        $page->addParagraph("Documentation for the API - which is further utilised in part 2 of the coursework - can be found on the Documentation page.");
        $page->addParagraph("The content returned by the API endpoints is a sample of data from the Designing Interactive Systems (DIS) conference.");
        $page->addParagraph("Please note: this work is not associated with or endorsed by the DIS conference.");
        return $page->generateWebpage();
    }
}