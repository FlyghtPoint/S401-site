<?php
namespace App\Controller;

use App\Model\ApiClient;

class FrontController {
    private $apiClient;
    private $twig;

    public function __construct(ApiClient $apiClient, \Twig\Environment $twig) {
        $this->apiClient = $apiClient;
        $this->twig = $twig;
    }

    public function getProducts() {
        $products = $this->apiClient->getProducts();
        // var_dump($products);
        echo $this->twig->render('products.twig', ['products' => $products]);
    }
}