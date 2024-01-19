<?php

class Order {
    public int $id;
    public int $userId;
    public string $createdAt;
    public array $items = [];

    public function __construct(int $id, int $userId, string $createdAt) {
        $this->id = $id;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
    }
}