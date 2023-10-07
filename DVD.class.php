<?php
class DVD extends Product {
    private $size;
    public function set_size(int $size): void {
        $this->size = $size;
    }

    public function get_size(): int {
        return $this->size;
    }
}