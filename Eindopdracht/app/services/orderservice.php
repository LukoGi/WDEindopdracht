<?php
require_once __DIR__ . '/../repositories/orderrepository.php';

class OrderService {
    private $orderRepository;

    public function __construct() {
        $this->orderRepository = new OrderRepository();
    }

    public function createOrder($userId) {
        return $this->orderRepository->createOrder($userId);
    }

    public function addProductToOrder($orderId, $productId) {
        $this->orderRepository->addProductToOrder($orderId, $productId);
    }

    public function getOrdersByUser($userId) {
        return $this->orderRepository->getOrdersByUser($userId);
    }
}