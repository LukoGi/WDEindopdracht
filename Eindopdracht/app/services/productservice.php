<?php
require_once __DIR__ . '/../repositories/productrepository.php';

class ProductService {
    private $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    public function GetAll() {
        return $this->productRepository->GetAll();
    }

    public function deleteProduct($id) {
        return $this->productRepository->deleteProduct($id);
    }

    public function addProduct(Product $product) {
        return $this->productRepository->addProduct($product);
    }
}