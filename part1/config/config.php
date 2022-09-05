<?php

/**
 * Configuration file.
 * 
 * @author Alex Hakesley w16011419
 */

include 'config/autoloader.php';
spl_autoload_register('autoloader');

define('BASEPATH', '/kf6012/coursework/part1/');
define('STYLE', BASEPATH . "assets/style.css");
define ('DISDB', 'db/dis.sqlite');
define('USERDB', 'db/user.sqlite');
define('READDB', 'db/readinglist.sqlite');
define('SECRET_KEY', 'ovBfwnmd"wNb4Bp');

define('DEVELOPMENT_MODE', false);

ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

include 'config/htmlexceptionhandler.php';
include 'config/jsonexceptionhandler.php';
set_exception_handler('JSONexceptionHandler');

include 'config/errorhandler.php';
set_error_handler('errorHandler');

?>