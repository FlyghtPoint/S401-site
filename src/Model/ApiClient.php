<?php
namespace App\Model;

class ApiClient {
    private $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    public function getProducts() {
        // Make a GET request to the API to get a list of products
        // This is a placeholder - replace this with your actual API request code
        return json_decode(file_get_contents($this->baseUrl . '/products'), true);
    }
}