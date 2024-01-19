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
        // Fetch the user's orders from the database
        $orders = $this->orderService->getOrdersByUser($_SESSION['user_id']);

        // Fetch product details for each item in the order
        $ordersWithDetails = [];
        foreach ($orders as $order) {
            $itemsWithDetails = [];
            foreach ($order->items as $item) {
                // Fetch the product details using $item['product_id']
                $product = $this->productService->getProduct($item['product_id']);

                // Add the product details to a new item array
                $itemWithDetails = $item;
                $itemWithDetails['title'] = $product->title; // Use object property access syntax
                $itemWithDetails['price'] = $product->price; // Use object property access syntax

                // Add the item with details to the itemsWithDetails array
                $itemsWithDetails[] = $itemWithDetails;
            }
            // Replace the order's items with the itemsWithDetails
            $order->items = $itemsWithDetails;
            // Add the order with details to the ordersWithDetails array
            $ordersWithDetails[] = $order;
        }
        // Replace the orders with the ordersWithDetails
        $orders = $ordersWithDetails;

        // Render the order history view, passing in the orders
        include '../views/orderhistory/orderhistoryview.php';
    }
}