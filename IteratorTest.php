<?php
require_once __DIR__ . '/vendor/autoload.php';

use TIterator\ProductList;

$products = [
    '人人都是产品经理',
    '大话设计模式',
    'Head First',
    '重构'
];

$list = new ProductList($products);// 构造聚合类
$list->add('代码整洁之道');
$iterator = $list->createIterator();

while ($iterator->hasNext()) {
    echo $iterator->getItem();
    $iterator->next();
}

