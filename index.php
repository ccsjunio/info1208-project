<?php

define("_ROOTFOLDER",$_SERVER['DOCUMENT_ROOT']);
define("_URLBASE",$_SERVER['SERVER_NAME']);

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        http_response_code(200);
        require __DIR__ . '/views/carlos_ferraz_submit.php';
        break;
    case '' :
        http_response_code(200);
        require __DIR__ . '/views/carlos_ferraz_submit.php';
        break;
    case '/functions' :
        http_response_code(200);
        require __DIR__ . '/views/carlos_ferraz_functions.php';
        break;
    case '/output' :
        http_response_code(200);
        require __DIR__ . '/views/carlos_ferraz_output.php';
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

?>