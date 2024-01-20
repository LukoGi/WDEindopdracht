<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/OrderService.php';
require_once __DIR__ . '/../services/ProductService.php';

class OrderHistoryController {
    private $orderService;
    private $productService;

    public function __construct() {
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
    }

    public function handleOrderHistory() {  
        $userId = htmlspecialchars($_SESSION['user_id']);
        
        $orders = $this->orderService->getOrdersByUser($_SESSION['user_id']);

        $ordersWithDetails = [];
        foreach ($orders as $order) {
            $itemsWithDetails = [];
            foreach ($order->items as $item) {
                $product = $this->productService->getProduct($item['product_id']);

                $itemWithDetails = $item;
                $itemWithDetails['title'] = $product->title;
                $itemWithDetails['price'] = $product->price; 


                $itemsWithDetails[] = $itemWithDetails;
            }

            $order->items = $itemsWithDetails;

            $ordersWithDetails[] = $order;
        }
        $orders = $ordersWithDetails;

        include '../views/orderhistory/orderhistoryview.php';
    }
}