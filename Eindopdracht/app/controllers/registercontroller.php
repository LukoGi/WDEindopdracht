<?php
require_once __DIR__ . '/../services/UserService.php';

class RegisterController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->registerUser();
        } else {
            require_once __DIR__ . '/../views/register/registerview.php';
        }
    }

    private function registerUser() {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if (strlen($password) < 8) {
            header('Location: /register');
            exit();
        }
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $this->userService->createUser($username, $hashed_password);
    
        header('Location: /login');
    }
}