<?php
require_once __DIR__ . '/../models/order.php';

class OrderRepository {
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=mysql;dbname=royalsuppsdb", "root", "secret123");
    }

    public function createOrder($userId) {
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $stmt->execute([$userId]);
        return $this->connection->lastInsertId();
    }

    public function addProductToOrder($orderId, $productId) {
        $orderId = filter_var($orderId, FILTER_SANITIZE_NUMBER_INT);
        $productId = filter_var($productId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("INSERT INTO order_items (order_id, product_id) VALUES (?, ?)");
        $stmt->execute([$orderId, $productId]);
    }

    public function getOrdersByUser($userId) {
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $orderObjects = [];
        foreach ($orders as $order) {
            // Replace 'userId' and 'createdAt' with the correct column names from your database
            $orderObject = new Order($order['id'], $order['user_id'], $order['created_at']);
            $orderObject->items = $this->getOrderItems($orderObject->id);
            $orderObjects[] = $orderObject;
        }
    
        return $orderObjects;
    }

    public function getOrderItems($orderId) {
        $orderId = filter_var($orderId, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}