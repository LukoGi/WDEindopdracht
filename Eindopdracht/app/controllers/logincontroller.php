<?php

class LoginController {

    public function __construct() {
        
    }

    public function handleLogin() {
        require_once __DIR__ . '/../views/login/loginview.php';
    }
}