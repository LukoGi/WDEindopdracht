<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/ProductService.php';

class CartController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function handleCart() {
        require_once __DIR__ . '/../views/cart/cartview.php';
    }

    public function addToCart() {
        // Start the session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Get the product ID from the request body
        $product_id = $_POST['product_id'];
    
        // Fetch the product data from the database
        // This assumes you have a ProductService with a getProduct method
        $product = $this->productService->getProduct($product_id);
    
        // Add the product to the cart in the session
        $_SESSION['cart'][] = $product;
    
        // Debug: capture the output of var_dump
        ob_start();
        var_dump($product_id, $product, $_SESSION['cart']);
        $debug_output = ob_get_clean();

        // Return a JSON response
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
}