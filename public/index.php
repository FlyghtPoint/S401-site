<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\AuthController;
use App\Controller\FrontController;
use App\Model\ApiClient;

$apiClient = new \App\Model\ApiClient('https://dev-lefevre216.users.info.unicaen.fr/S401');
$loader = new \Twig\Loader\FilesystemLoader('../src/View');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$frontController = new \App\Controller\FrontController($apiClient, $twig);
$authController = new \App\Controller\AuthController($apiClient, $twig);

// Create the session if it doesn't exist
if (!isset($_COOKIE['status'])) {
    setcookie('status', 'customer', time() + (86400 * 30), "/"); // 86400 = 1 day
}

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