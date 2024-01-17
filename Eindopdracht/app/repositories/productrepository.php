<?php
require_once __DIR__ . '/../models/product.php';

class ProductRepository {
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=mysql;dbname=royalsuppsdb", "root", "secret123");
    }

    public function GetAll() {
        $stmt = $this->connection->prepare("SELECT * FROM products");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $stmt->fetchAll();
    }

    public function deleteProduct($id) {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}