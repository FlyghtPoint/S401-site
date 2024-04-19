<?php
namespace App\Controller;

use App\Model\ApiClient;
use App\Controller\AuthController;

class FrontController {
    private $apiClient;
    private $twig;

    public function __construct(ApiClient $apiClient, \Twig\Environment $twig) {
        $this->apiClient = $apiClient;
        $this->twig = $twig;
    }

    public function home() {
        // Home page logic
        $authController = new AuthController($this->apiClient, $this->twig);
        echo $authController->redirectBasedOnStatus();
    }

    public function getProducts() {
        // Get the products from the API
        $products = $this->apiClient->getProducts();
        
        // Get the current page number from the query parameter
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Define the number of products per page
        $productsPerPage = 25;

        // Calculate the offset for the products array
        $offset = ($page - 1) * $productsPerPage;

        // Get the products for the current page
        $productsForCurrentPage = array_slice($products, $offset, $productsPerPage);

        // Calculate the total number of pages
        $totalPages = ceil(count($products) / $productsPerPage);

        // Render the Twig template and pass the products and total pages as variables
        echo $this->twig->render('customer/products.twig', [
            'products' => $productsForCurrentPage,
            'totalPages' => $totalPages,
        ]);
    }
}