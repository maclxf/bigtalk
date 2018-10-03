<?php
namespace TIterator;

class ProductList extends PList {

    public function __construct(array $list) {
        parent::__construct($list);
    }

    public function createIterator() {
        return new ProductIterator($this);
    }
}
