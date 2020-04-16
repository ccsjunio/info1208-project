<?php
/*
* This is the entry point of the site, serve to include the necessary
* files, functions and libraries and load the correct code to build the
* page called by the user. The page code is called according to the
* http request parameter. This page serves as a simple router
*/


// enable all error messages
// to be active only on development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// define the path to the root folder of the site in the web server
define("ROOTFOLDER",$_SERVER['DOCUMENT_ROOT']);
// define the url page as reference for the front end
define("URLBASE",$_SERVER['SERVER_NAME']);

// call the autoloader to load the packages necessary in this application
// for this application the package used is the dotenv, to load
// environment variable from the .env file
require_once ROOTFOLDER . '/vendor/autoload.php';

// include the functions file that will serve all pages
require_once(ROOTFOLDER."/views/carlos_ferraz_functions.php");

// define and load the environment file with environment variables
// loaded from the root folder of the site
$dotenv =  Dotenv\Dotenv::createImmutable(ROOTFOLDER);
$dotenv->load();

// identify the page to be loaded from the requested URI
$request = $_SERVER['REQUEST_URI'];

// identify the page to be loaded according to the request
switch ($request) {
    // load the submit page as default without URI suffix
    case '/' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    // load the submit page as default without URI suffix
    case '' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    // load the submit page as explicitly called
    case '/submit' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
        break;
    // load the functions page, although in this case still does not
    // makes sense or is useful
    case '/functions' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_functions.php';
        break;
    // load the output page that processes the call from the form
    // submiting the movie information
    case '/output' :
        http_response_code(200);
        require ROOTFOLDER . '/views/carlos_ferraz_output.php';
    break;
    // load the submit page, but enabling the flag
    // to reset the submissions counter.
    // available only in the phase of development
    case '/reset' :
        http_response_code(200);
        $resetSubmissions = true;
        require ROOTFOLDER . '/views/carlos_ferraz_submit.php';
    break;
    // if the request is not identified, loads the 404 page
    // indicating the request could not be fulfiled
    default:
        http_response_code(404);
        require ROOTFOLDER . '/views/404.php';
        break;
}

?>