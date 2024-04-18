<?php
$apiClient = new \App\Model\ApiClient('https://dev-lefevre216.users.info.unicaen.fr/S401');
$loader = new \Twig\Loader\FilesystemLoader('../src/View');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$frontController = new \App\Controller\FrontController($apiClient, $twig);
// $authController = new \App\Controller\AuthController($apiClient, $twig);

// Add this route
$routes = [

    // ! Front office
    [
        'method' => 'GET',
        'path' => '/S401-site/',
        'controller' => $frontController,
        'action' => 'home',
    ],
    [
        'method' => 'GET',
        'path' => '/S401-site/products',
        'controller' => $frontController,
        'action' => 'getProducts',
    ],

    // ! Back office

    // ! Authentification
    [
        'method' => 'POST',
        'path' => '/S401-site/login',
        // 'controller' => $authController,
        'action' => 'login',
    ],
];

return $routes;
?>