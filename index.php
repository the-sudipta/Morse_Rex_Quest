<?php
//require './Navigation_Links.php';
require './routes.php';
require './utils/system_functions.php';
global $frontend_routes, $system_routes;

$error_404 = $system_routes['error_404'];


if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
 // Redirect to the custom 404 page
 navigate($error_404);
 exit();
}

if (http_response_code() == 500) {
 // Redirect to the custom 500 page

// navigate($error_500);
 exit();
}
session_start();
$login_page = $frontend_routes['game'];
navigate($login_page);


?>
