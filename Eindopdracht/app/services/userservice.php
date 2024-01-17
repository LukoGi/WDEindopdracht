<?php
require_once __DIR__ . '/../repositories/userrepository.php';

class UserService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function GetAll() {
        return $this->userRepository->GetAll();
    }

    public function createUser($username, $hashed_password) {
        $this->userRepository->createUser($username, $hashed_password);
    }

    public function getUserByUsername($username) {
        return $this->userRepository->getUserByUsername($username);
    }
}