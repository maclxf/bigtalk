<?php
namespace Bridge;
use Bridge\Product;

class HouseProd extends Product {

    public function beProduct() {
        echo '建房子<br>';
    }

    public function sellProduct() {
        echo '买房子<br>';
    }

}