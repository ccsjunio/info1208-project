<?php
define("ROOTFOLDER",$_SERVER['DOCUMENT_ROOT']);
define("URLBASE",$_SERVER['SERVER_NAME']);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    case '' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    case '/submit' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    case '/functions' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_functions.php';
        break;
    case '/output' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_output.php';
    break;
    default:
        http_response_code(404);
        require ROOTFOLDER . '/views/404.php';
        break;
}

?>