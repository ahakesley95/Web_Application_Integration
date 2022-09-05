<?php

/**
 * Controls the gateway to the base (/api) endpoint.
 * 
 * Returns static information about the API and author.
 * 
 * @author Alex Hakesley w16011419
 */

class ApiBaseController extends Controller {

    protected function processRequest() {
        $this->getResponse()->setStatusCode(200);
        $this->getResponse()->setMessage("OK");
        $data['author']['name'] = "Alex Hakesley";
        $data['author']['studentId'] = "w16011419";
        $data['author']['emailAddress'] = "alex.s.hakesley@northumbria.ac.uk";
        $data['about']['description'] = "This API can be used to find different papers and authors from the DIS conference.";
        $data['about']['disclaimer'] = "This API is not associated with or endorsed by the Designing Interactive Systems (DIS) conference.";
        $data['about']['documentation'] = "Documentation can be found at https://localhost/kf6012/assessment/part1/documentation";

        return $data;

    }
}