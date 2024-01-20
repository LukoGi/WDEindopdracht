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

        // Return a JSON response
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function removeFromCart() {
        // Start the session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Get the product key from the request body
        $product_key = $_POST['product_key'];
    
        // Remove the product from the cart in the session
        unset($_SESSION['cart'][$product_key]);
    
        // Redirect back to the cart page
        header('Location: /cart');
    }

    public function createOrder() {
        // Start the session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Check if a user is logged in
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
        // Create a new order for the current user (or a guest if no user is logged in)
        $orderId = $this->orderService->createOrder($userId);
    
        // Add each product in the cart to the order
        foreach ($_SESSION['cart'] as $product) {
            $this->orderService->addProductToOrder($orderId, $product->id); // assuming quantity is always 1
        }
    
        // Clear the cart
        $_SESSION['cart'] = [];
    
        // Redirect the user to a success page
        header('Location: /ordersuccess');
    }
}