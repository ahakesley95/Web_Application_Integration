<?php

/**
 * Controls the gateway to the Authors (api/authors) endpoint.
 * 
 * Calls function to find author with specific id, if 'id'
 * parameter is provided. Otherwise, calls function to return 
 * all authors in db.
 * 
 * @author Alex Hakesley w16011419
 */

class ApiAuthorController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new AuthorGateway();
    }

    protected function processRequest() {
        $request = $this->getRequest();
        $id = $request->getParameter("id");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (is_null($id)){
                $this->getGateway()->findAll();
            } else {
                $this->getGateway()->findById($id);
                if (count($this->getGateway()->getResult())==0) {
                    $this->getResponse()->setMessage("Not found");
                    $this->getResponse()->setStatusCode(404);
                }
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode("405");
        }

        return $this->getGateway()->getResult();
    }
}