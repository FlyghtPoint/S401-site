<?php
require_once '../vendor/autoload.php';

// Load the routes
$routes = require_once '../routes/routes.php';

// Get the current path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Find the matching route
foreach ($routes as $route) {
    if ($route['method'] === $_SERVER['REQUEST_METHOD'] && $route['path'] === $path) {
        // Call the controller action
        $controller = $route['controller'];
        $action = $route['action'];
        $controller->$action();
        exit;
    }
}

// No matching route found
http_response_code(404);
echo 'Not found';
?>