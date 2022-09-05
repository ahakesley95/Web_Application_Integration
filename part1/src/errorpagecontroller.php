<?php

/**
 * Controls the content and generation of the Error page.
 * 
 * @author Alex Hakesley w16011419
 */

class ErrorPageController extends Controller {

    protected function processRequest() {
        $links = ["Home"=>"home",
          "Documentation"=>"documentation"];
        $page = new ErrorPage("Error", $links, "error", "");
        $page->addHeading2("The page you were looking for could not be found.");
        $page->addParagraph("Use the menu at the top of the screen to get to the page you need.");
        return $page->generateWebpage();
    }
}