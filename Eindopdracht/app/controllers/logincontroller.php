<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/UserService.php';

class LoginController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->loginUser();
        } else {
            require_once __DIR__ . '/../views/login/loginview.php';
        }
    }

    private function loginUser() {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $user = $this->userService->getUserByUsername($username);
    
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            header('Location: /');
        } else {
            require_once __DIR__ . '/../views/login/loginview.php';
        }
    }
}