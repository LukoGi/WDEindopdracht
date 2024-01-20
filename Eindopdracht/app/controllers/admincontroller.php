<?php
require_once __DIR__ . '/../services/ProductService.php';

class AdminController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function handleAdmin() {
        $products = $this->productService->getAll();
        require_once __DIR__ . '/../views/admin/adminview.php';
    }

    public function deleteProduct() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->productService->deleteProduct($id);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not delete product']);
        }
    }

    public function addProduct() {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
    
        $product = new Product();
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;
        $product->category = $category;
        $product->image = $image;
    
        $result = $this->productService->addProduct($product);
    
        if ($result) {
            header('Location: /admin');
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not add product']);
        }
    }

    public function getProduct() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $product = $this->productService->getProduct($id);
    
        if ($product) {
            echo json_encode($product);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not fetch product']);
        }
    }

    public function editProduct() {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
    
        $product = new Product();
        $product->id = $id;
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;
        $product->category = $category;
        $product->image = $image;
    
        $result = $this->productService->editProduct($product);
    
        if ($result) {
            header('Location: /admin');
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not edit product']);
        }
    }
}