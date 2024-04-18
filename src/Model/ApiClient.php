<?php
namespace App\Model;

class ApiClient {
    private $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    public function getProducts() {
        return json_decode(file_get_contents($this->baseUrl . '/products'), true);
    }
}