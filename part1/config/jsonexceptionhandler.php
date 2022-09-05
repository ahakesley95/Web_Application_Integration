<?php 

/**
 * Returns an error in JSON format.
 * 
 * @author Alex Hakesley w16011419
 */

function JSONexceptionHandler($e) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $output['statusCode'] = 500;
    $output['message'] = "Internal Server Error";

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }

    echo json_encode($output);
}