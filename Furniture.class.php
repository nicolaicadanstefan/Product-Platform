<?php
class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function set_height(float $height): void {
        $this->height = $height;
    }

    public function get_height(): float {
        return $this->height;
    }

    public function set_width(float $width): void {
        $this->width = $width;
    }

    public function get_width(): float {
        return $this->width;
    }

    public function set_length(float $length): void {
        $this->length = $length;
    }

    public function get_length(): float {
        return $this->length;
    }
}