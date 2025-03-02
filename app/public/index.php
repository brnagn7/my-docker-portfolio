<?php
require_once __DIR__ . '/../web.php';
require_once __DIR__ . '/../Database.php';

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize router
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$routes = getRoutes();

// Basic routing
if (array_key_exists($request_uri, $routes)) {
    $handler = $routes[$request_uri];
    $handler();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 - Page not found";
    echo "<br><a href='/'>Back to Home</a>";
}
