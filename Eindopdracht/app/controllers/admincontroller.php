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
        $id = $_GET['id'];
        $result = $this->productService->deleteProduct($id);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not delete product']);
        }
    }

    public function addProduct() {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image = $_POST['image'];
    
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
}