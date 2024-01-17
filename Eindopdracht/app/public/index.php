<?php
$url = $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../controllers/homecontroller.php';
require_once __DIR__ . '/../controllers/logincontroller.php';
require_once __DIR__ . '/../controllers/registercontroller.php';

switch ($url) {
    case '/':
        $homeController = new HomeController();
        $homeController->handleHome();
        break;
    case '/login':
        $loginController = new LoginController();
        $loginController->handleLogin();
        break;
    case '/register':
        $registerController = new RegisterController();
        $registerController->handleRegister();
        break;
    default:
        http_response_code(404);
}