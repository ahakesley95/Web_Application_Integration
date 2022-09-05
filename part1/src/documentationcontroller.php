<?php

/**
 * Controls the contents and generation of the Documentation 
 * page.
 * 
 * Adds specific, static information for each endpoint to the 
 * documentation page.
 * 
 * @author Alex Hakesley w16011419
 */

class DocumentationController extends Controller {

    protected function processRequest() {
        $links = ["Home"=>"home",
          "Documentation"=>"documentation"];
        $page = new DocumentationPage("Documentation", $links, "documentation", "Documentation");
        $this->addBaseEndpoint($page);
        $this->addAuthorsEndpoint($page);
        $this->addPapersEndpoint($page);
        $this->addAuthenticateEndpoint($page);
        $this->addReadingListEndpoint($page);
        return $page->generateWebpage();
    }

    private function addBaseEndpoint($page) {
      $responseInfo = array(
        "(author) name" => "The name of the API author.",
        "(author) studentId" => "The student ID of the API author.",
        "(author) emailAddress" => "The email address of the API author.",
        "(about) description" => "A brief description of the API.",
        "(about) disclaimer" => "Notice of no association with DIS conference.",
        "(about) documentation" => "A brief description of the documentation of the API."
        );

      $exampleResponse = array(
        "message" => "OK",
        "statusCode" => 200,
        "count" => 2,
        "results" => array(
          "author" => array(
            "name" => "Alex Hakesley",
            "studentId" => "w16011419",
            "emailAddress" => "alex.s.hakesley@northumbria.ac.uk"
          ),
          "about" => array(
            "description" => "This API can be used to find different papers and authors from the DIS conference.",
            "disclaimer" => "This API is not associated with or endorsed by the Designing Interactive Systems (DIS) conference.",
            "documentation" => "Documentation can be found at https://localhost/kf6012/assessment/part1/documentation"
          )
        )
      );

      $page->addDocumentation(
        "api", 
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api", 
        ["GET"], 
        [], 
        array("200" => "OK"),
        $responseInfo,
        "This example returns general information about the API. Note: the information shown will not change.",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api",
        $exampleResponse
      );
    }

    private function addAuthorsEndpoint($page) {
      $responseInfo = array (
        "author_id" => "The unique ID of the author.",
        "last_name" => "The last name of the author.",
        "first_name" => "The first name of the author."
      );

      $exampleResponse = array(
        "message" => "OK",
        "statusCode" => 200,
        "count" => 1,
        "results" => array(
          "0" => array(
            "author_id" => "60047",
            "last_name" => "Alhakamy",
            "first_name" => "A'aeshah"
          )
        )
          );
      $page->addDocumentation(
        "api/authors",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authors",
        ["GET"],
        array(
          "id (optional)" => "The ID of the author to be returned."
        ),
        array("200" => "OK", "405" =>  "Method Not Allowed"),
        $responseInfo,
        "This example returns the Author information for id 60047.",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?id=60047",
        $exampleResponse
      );
    }

    private function addPapersEndpoint($page) {
      $responseInfo = array(
        "id" => "The unique ID of the paper.",
        "title" => "The title of the paper.",
        "abstract" => "The abstract of the paper.",
        "authors"=> "The names of the authors of the paper.",
        "award" => "The name of the award given to the paper.",
        "doi" => "A link to the full version of the paper."
      );

      $exampleResponse = array(
        "message" => "OK",
        "statusCode" => 200,
        "count" => 1,
        "results" => array(
          "0" => array(
            "id" => "60195",
            "title" => "Wikipedia ORES Explorer: Visualizing Trade-offs For Designing Applications With Machine Learning API",
            "abstract" => "With the growing industr... AI application design.",
            "authors" => "Zining Ye, Xinran Yuan, Shaurya Gaur, Aaron Halfaker, Jodi Forlizzi, Haiyi Zhu",
            "award" => null,
            "doi" => "https://dl.acm.org/doi/10.1145/3461778.3462099"
          )
        )
          );
      $page->addDocumentation(
        "api/papers",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/papers",
        ["GET"],
        array(
          "id (optional)"=>"The ID of the paper.",
          "author_id (optional)"=>"The ID of the paper's author.",
          "award_id (optional)"=>"The ID of the paper's award.",
          "random (optional)"=>"Returns a random paper."
        ),
        array("200" => "OK", "405" => "Method Not Allowed"),
        $responseInfo,
        "This example returns Paper information for a randomly selected paper.",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?random",
        $exampleResponse
      );
    }

    private function addAuthenticateEndpoint($page) {
      $responseInfo = array(
        "token" => "A generated token to be used when accessing the 'readingList' endpoint."
      );

      $exampleResponse = array(
        "message" => "OK",
        "statusCode" => 200,
        "count" => 1,
        "results" => array(
          "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTY0ODQ3NTI4OX0.NT2LXl-4trhcsBy8ajySg0iQTSQ-2dCcUgigoH3HDeg"
        )
        );
      $page->addDocumentation(
        "api/authenticate",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate",
        ["POST"],
        array(
          "email (required)"=>"An email address.",
          "password (required)"=>"A password."
        ),
        array("200" => "OK", "401" => "Unauthorized", "405" => "Method Not Allowed"),
        $responseInfo,
        "This example returns an authorisation token when provided with a valid email address and password.",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate?email=me@example.com&password=mypassword",
        $exampleResponse
      );
    }

    private function addReadingListEndpoint($page) {
      $responseInfo = array(
        "paper_id" => "The unique ID of the paper in the reading list.",
      );
      $exampleResponse = array(
        "message" => "OK",
        "statusCode" => 200,
        "count" => 2,
        "results" => array(
          array("paper_id" => "60114"),
          array("paper_id" => "60101")
        )
        );
      $page->addDocumentation(
        "api/readinglist",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist",
        ["POST"],
        array(
          "token (required)"=>"A token generated by the 'authenticate' endpoint.", 
          "add (optional)"=>"The ID of the paper to be added.",
          "remove (optional)"=>"The ID of the paper to be removed.",
          "removeAll (optional)"=>"Removes all paper IDs from the reading list."
        ),
        array("204" => "No Content", "401" => "Unauthorized", "405" => "Method Not Allowed"),
        $responseInfo,
        "This example shows a returned list of papers stored in the user's reading list.",
        "http://unn-w16011419.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTY0ODQ3NTI4OX0.NT2LXl-4trhcsBy8ajySg0iQTSQ-2dCcUgigoH3HDeg",
        $exampleResponse
      );
    }



}