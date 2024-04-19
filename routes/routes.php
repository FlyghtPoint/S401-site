<?php
// $apiClient = new \App\Model\ApiClient('https://dev-lefevre216.users.info.unicaen.fr/S401');
// $loader = new \Twig\Loader\FilesystemLoader('../src/View');
// $twig = new \Twig\Environment($loader, [
//     'debug' => true,
// ]);

// $twig->addExtension(new \Twig\Extension\DebugExtension());

// $frontController = new \App\Controller\FrontController($apiClient, $twig);
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

    // ? Brands

    // 'employees/brands'
    [
        'method' => 'GET',
        'path' => '/S401-site/employees/brands',
        'controller' => $backController,
        'action' => 'getBrands',
    ],

    // ? Categories

    // 'employees/categories'
    [
        'method' => 'GET',
        'path' => '/S401-site/employees/categories',
        'controller' => $backController,
        'action' => 'getCategories',
    ],

    // ? Employees

    // 'chief/employees'
    [
        'method' => 'GET',
        'path' => '/S401-site/chief/employees',
        'controller' => $backController,
        'action' => 'getEmployeesForChief',
    ],

    // 'it/employees'
    [
        'method' => 'GET',
        'path' => '/S401-site/it/employees',
        'controller' => $backController,
        'action' => 'getEmployees',
    ],


    // ? Stocks

    // 'employees/brands'
    [
        'method' => 'GET',
        'path' => '/S401-site/employees/brands',
        'controller' => $backController,
        'action' => 'getBrands',
    ],

    // ? Stores

    // 'employees/brands'
    [
        'method' => 'GET',
        'path' => '/S401-site/employees/brands',
        'controller' => $backController,
        'action' => 'getBrands',
    ],


    // ! Authentification
    // Login
    [
        'method' => 'POST',
        'path' => '/S401-site/login',
        'controller' => $authController,
        'action' => 'login',
    ],
    // Logout
    [
        'method' => 'GET',
        'path' => '/S401-site/logout',
        'controller' => $authController,
        'action' => 'logout',
    ],
];

return $routes;
?>