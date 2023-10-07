<?php
abstract class Product {
    private $SKU;
    private $name;
    private $price;
    public function set_sku(string $SKU): void {
        $this->SKU = $SKU;
    }

    public function get_sku(): string {
        return $this->SKU;
    }
    
    public function set_name(string $name): void {
        $this->name = $name;
    }

    public function get_name(): string {
        return $this->name;
    }

    public function set_price(float $price): void {
        $this->price = $price;
    }

    public function get_price(): float{
        return $this->price;
    }
}