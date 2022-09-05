<?php

/**
 * Includes relevant file for a class that has been referenced.
 * 
 * @author Alex Hakesley w16011419
 */

function autoloader($className) {
    $filename = "src\\" . strtolower($className) .".php";
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $filename);
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        exit("File not found: " . $className . " (" . $filename . ")");
    }
}