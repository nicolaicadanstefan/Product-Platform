<?php
class Book extends Product {
    private $weight;
    public function set_weight(float $weight): void {
        $this->weight = $weight;
    }
    public function get_weight(): float {
        return $this->weight;
    }
}