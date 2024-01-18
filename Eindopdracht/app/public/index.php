<?php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require_once __DIR__ . '/../controllers/homecontroller.php';
require_once __DIR__ . '/../controllers/logincontroller.php';
require_once __DIR__ . '/../controllers/registercontroller.php';
require_once __DIR__ . '/../controllers/logoutcontroller.php';
require_once __DIR__ . '/../controllers/admincontroller.php';
require_once __DIR__ . '/../controllers/cartcontroller.php';

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
    case '/admin/editProduct':
        $adminController = new AdminController();
        $adminController->editProduct();
        break;
    case '/admin/getProduct':
        $adminController = new AdminController();
        $adminController->getProduct();
        break;
    case '/cart':
        $cartController = new CartController();
        $cartController->handleCart();
        break;
    case '/cart/addToCart':
        $cartController = new CartController();
        $cartController->addToCart();
        break;
    case '/cart/removeFromCart':
        $cartController = new CartController();
        $cartController->removeFromCart();
        break;
    default:
        http_response_code(404);
}