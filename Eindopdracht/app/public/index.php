<?php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require_once __DIR__ . '/../controllers/homecontroller.php';
require_once __DIR__ . '/../controllers/logincontroller.php';
require_once __DIR__ . '/../controllers/registercontroller.php';
require_once __DIR__ . '/../controllers/logoutcontroller.php';
require_once __DIR__ . '/../controllers/admincontroller.php';

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
    case '/admin':
        $adminController = new AdminController();
        $adminController->handleAdmin();
        break;
    case '/admin/deleteProduct':
        $adminController = new AdminController();
        $adminController->deleteProduct();
        break;
    case '/admin/addProduct':
        $adminController = new AdminController();
        $adminController->addProduct();
        break;
    default:
        http_response_code(404);
}