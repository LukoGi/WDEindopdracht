<?php

class Order {
    public int $id;
    public int $userId;
    public string $createdAt;
    public array $items = [];
}