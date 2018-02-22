<?php
namespace Bridge;

abstract class Corp {
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    abstract public function makeMoney();
}