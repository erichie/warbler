<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

// set HTTP Response headers
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include composer stuff and custom classes
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/db/DBHelper.php';