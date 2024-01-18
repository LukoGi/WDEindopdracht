<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CartController {

    public function __construct() {
        
    }

    public function handleCart() {
        require_once __DIR__ . '/../views/cart/cartview.php';
    }
}