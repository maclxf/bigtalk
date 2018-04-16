<?php
namespace Bridge;
use Bridge\Corp;

class HouseCorp extends Corp {
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function makeMoney() {
        $this->product->beProduct();
        $this->product->sellProduct();
    }
}