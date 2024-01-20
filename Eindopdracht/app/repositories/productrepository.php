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
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function addProduct(Product $product) {
        $product->title = filter_var($product->title, FILTER_SANITIZE_STRING);
        $product->description = filter_var($product->description, FILTER_SANITIZE_STRING);
        $product->price = filter_var($product->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $product->category = filter_var($product->category, FILTER_SANITIZE_STRING);
        $product->image = filter_var($product->image, FILTER_SANITIZE_URL);
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
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $stmt->fetch();
    }

    public function editProduct(Product $product) {
        $product->title = filter_var($product->title, FILTER_SANITIZE_STRING);
        $product->description = filter_var($product->description, FILTER_SANITIZE_STRING);
        $product->price = filter_var($product->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $product->category = filter_var($product->category, FILTER_SANITIZE_STRING);
        $product->image = filter_var($product->image, FILTER_SANITIZE_URL);
        $product->id = filter_var($product->id, FILTER_SANITIZE_NUMBER_INT);

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