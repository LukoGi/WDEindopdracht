<?php
require_once __DIR__ . '/../services/ProductService.php';

class HomeController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function index() {
        $products = $this->productService->getAll();
        require_once __DIR__ . '/../views/home/index.php';
    }
}