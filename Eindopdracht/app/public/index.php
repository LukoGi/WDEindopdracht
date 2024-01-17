<?php
$url = $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../controllers/homecontroller.php';
require_once __DIR__ . '/../controllers/logincontroller.php';
require_once __DIR__ . '/../controllers/registercontroller.php';
require_once __DIR__ . '/../controllers/logoutcontroller.php';

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
    case '/logout':
        $logoutController = new LogoutController();
        $logoutController->handleLogout();
        break;
    default:
        http_response_code(404);
}