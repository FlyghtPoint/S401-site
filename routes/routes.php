<?php
$apiClient = new \App\Model\ApiClient('http://localhost/S401');
$loader = new \Twig\Loader\FilesystemLoader('../src/View');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$frontController = new \App\Controller\FrontController($apiClient, $twig);

// Add this route
$routes[] = [
    'method' => 'GET',
    'path' => '/S401-site/',
    'controller' => $frontController,
    'action' => 'getProducts',
];

return $routes;
?>