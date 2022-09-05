<?php

/**
 * Formats and displays documentation data in a webpage.
 * 
 * @author Alex Hakesley w16011419
 */

class DocumentationPage extends Webpage {

    public function addDocumentation($name, $url, $supportedMethods, $supportedParameters, $likelyStatusCodes,
     $responseInfo, $exampleDescription, $exampleRequest, $exampleResponse) {
        $supportedMethods = $this->getSupportedMethods($supportedMethods);
        $supportedParameters = $this->getSupportedParameters($supportedParameters);
        $likelyStatusCodes = $this->getLikelyStatusCodes($likelyStatusCodes);
        $responseInfo = $this->getResponseInfo($responseInfo);
        $exampleResponse = $this->getExampleResponse($exampleResponse);
        $documentation =  <<<EOT
        <div class="endpoint-doc">
            <h3>$name</h3>
            <h4>Link: <a href=$url>$url</a></h4>
            <hr>
            <h4>Supported HTTP methods</h4>
            <div>$supportedMethods</div>
            <hr>
            <h4>Supported parameters</h4>
            $supportedParameters
            <hr>
            <h4>Likely HTTP status codes</h4>
            $likelyStatusCodes
            <hr>
            <h4>Likely JSON response</h4>
            $responseInfo
            <hr>
            <div class="example-section">
                <h4>Example</h4>
                <p>$exampleDescription</p>
                <p>Request</p>
                <p class="example-container">$exampleRequest</p>
                <p>Response</p>
                $exampleResponse
            </div>
        </div>
EOT;
        $this->setBody($documentation);
    }

    //formats supported request methods into paragraphs
    private function getSupportedMethods($supportedMethods) {
        $section = "";
        for ($i = 0; $i < count($supportedMethods); $i++) {
            $section .= "<p>$supportedMethods[$i]</p>";
        }
        return $section;
    }

    //formats the supported parameters argument into a table.
    private function getSupportedParameters($supportedParameters) {
        $section = "<table class='supported-params-table'>";

        if (count($supportedParameters) > 0) {
            $section .= "<tr class='supported-params-heading'><td>Parameter</td><td>Use</td></tr>";
            foreach($supportedParameters as $key => $value) {
                $section .= "<tr><td>$key</td><td>$value</td></tr>";
            }
            $section .= "</table>";
        } else {
            $section = "<p>None required</p>";
        }
        return $section;
    }

    //formats likely response values into a table.
    private function getResponseInfo($responseInfo) {
        $section = "<table class='likely-response-table'>";
        $section .= "<tr class='likely-response-heading'><td>Parameter</td><td>Description</td></tr>";
        foreach($responseInfo as $key => $value) {
            $section .= "<tr><td>$key</td><td>$value</td></tr>";
        }
        $section .= "</table>";
        return $section;
    }

    //formats likely status code argument into a table.
    private function getLikelyStatusCodes($likelyStatusCodes) {
        $section = "<table class='likely-status-codes-table'>";
        $section .= "<tr class='likely-status-code-heading'><td>Status Code</td><td>Status Text</td></tr>";

        foreach($likelyStatusCodes as $key => $value) {
            $section .= "<tr><td>$key</td><td>$value</td></tr>";
        }
        $section .= "</table>";
        return $section;
    }

    //formats example response into JSON pretty print
    private function getExampleResponse($exampleResponse) {
        return "<div class='example-container'><pre>" . json_encode($exampleResponse, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) . "</pre></div>";
    }
}