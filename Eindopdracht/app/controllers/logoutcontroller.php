<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class LogoutController {

    public function __construct() {

    }

    public function handleLogout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}