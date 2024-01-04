<?php
$url = $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../controllers/homecontroller.php';

switch ($url) {
    case '/':
        $homeController = new HomeController();
        $homeController->Index();
        break;
    default:
        http_response_code(404);
}