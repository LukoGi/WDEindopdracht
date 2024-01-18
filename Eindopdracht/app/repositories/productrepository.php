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

    public function addProduct(Product $product) {
        $stmt = $this->connection->prepare("
            INSERT INTO products (title, description, price, category, image) 
            VALUES (?, ?, ?, ?, ?)
        ");
    
        return $stmt->execute([
            $product->title, 
            $product->description, 
            $product->price, 
            $product->category, 
            $product->image
        ]);
    }

    public function getProduct($id) {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $stmt->fetch();
    }

    public function editProduct(Product $product) {
        $stmt = $this->connection->prepare("
            UPDATE products 
            SET title = ?, description = ?, price = ?, category = ?, image = ? 
            WHERE id = ?
        ");
    
        return $stmt->execute([
            $product->title, 
            $product->description, 
            $product->price, 
            $product->category, 
            $product->image,
            $product->id
        ]);
    }
}