<?php
require_once __DIR__ . '/../models/user.php';

class UserRepository {
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=mysql;dbname=royalsuppsdb", "root", "secret123");
    }

    public function GetAll() {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        return $stmt->fetchAll();
    }

    public function createUser($username, $hashed_password) {
        $username = htmlspecialchars($username);
        $stmt = $this->connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
    }

    public function getUserByUsername($username) {
        $username = htmlspecialchars($username);
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        return $stmt->fetch();
    }
}