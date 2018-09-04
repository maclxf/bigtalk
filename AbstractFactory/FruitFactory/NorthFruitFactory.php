<?php
namespace AbstractFactory\FruitFactory;


use AbstractFactory\FruitFactory AS aff;
use AbstractFactory\Fruit\NorthApple;
use AbstractFactory\Fruit\NorthBear;

// 产品结构
class NorthFruitFactory extends aff\FruitFactory {
    public function getApple() {
        return new NorthApple();
    }

    public function getBear() {
        return new NorthBear();
    }
}
