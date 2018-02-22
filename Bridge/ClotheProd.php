<?php
namespace Bridge;
use Bridge\Product;

class ClotheProd extends Product {

    public function beProduct() {
        echo '做衣服<br>';
    }

    public function sellProduct() {
        echo '卖衣服<br>';
    }

}