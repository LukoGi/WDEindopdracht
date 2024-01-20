<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/ProductService.php';
require_once __DIR__ . '/../services/OrderService.php';

class CartController {
    private $productService;
    private $orderService;

    public function __construct() {
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
    }

    public function handleCart() {
        require_once __DIR__ . '/../views/cart/cartview.php';
    }

    public function addToCart() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $product_id = htmlspecialchars($_POST['product_id']);
    
        $product = $this->productService->getProduct($product_id);
    
        $_SESSION['cart'][] = $product;
    
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function removeFromCart() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $product_key = htmlspecialchars($_POST['product_key']);
    
        unset($_SESSION['cart'][$product_key]);
    
        header('Location: /cart');
    }

    public function createOrder() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $userId = isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : null;
    
        $orderId = $this->orderService->createOrder($userId);
    
        foreach ($_SESSION['cart'] as $product) {
            $this->orderService->addProductToOrder($orderId, $product->id); 
        }
    
        $_SESSION['cart'] = [];
    
        header('Location: /ordersuccess');
    }
}