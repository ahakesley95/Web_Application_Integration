<?php

/**
 * Controls the gateway to the Papers (api/papers) endpoint.
 * 
 * Returns papers with 'id', 'author_id', 'award-id' or random papers,
 * if specified. Otherwise, returns all papers in db.
 * 
 * @author Alex Hakesley w16011419
 */

class ApiPaperController extends Controller {

    protected function setGateway() {
        $this->gateway = new PaperGateway();
    }

    protected function processRequest() {
        $id = $this->getRequest()->getParameter("id");
        $author_id = $this->getRequest()->getParameter("author_id");
        $award_id = $this->getRequest()->getParameter("award_id");
        $random = $this->getRequest()->getParameter("random");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->getGateway()->findById($id);
                if (count($this->getGateway()->getResult())==0) {
                    $this->getResponse()->setMessage("Not found");
                    $this->getResponse()->setStatusCode(404);
                }
            } elseif (!is_null($author_id)) {
                $this->getGateway()->findByAuthorId($author_id);
                if (count($this->getGateway()->getResult())==0) {
                    $this->getResponse()->setMessage("Not found");
                    $this->getResponse()->setStatusCode(404);
                }
            } elseif (!is_null($award_id)) {
                $this->getGateway()->findByAwardId($award_id);
                if (count($this->getGateway()->getResult())==0) {
                    $this->getResponse()->setMessage("Not found");
                    $this->getResponse()->setStatusCode(404);
                }
            } elseif (!is_null($random)) {
                $this->getGateway()->findRandom();
            } else {
                $this->getGateway()->findAll();
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode("405");
        }

        return $this->getGateway()->getResult();
    }
}