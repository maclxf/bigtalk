<?php
require_once 'save_the_world/SuperModuleInterface.php'
require_once 'save_the_world/Container.php';

// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂添加超人的生产脚本
$container->bind('superman', function($container, $moduleName) {
        var_dump($container);
    var_dump($moduleName);

    return new Superman($container->make($moduleName));
});
$container->bind('love', function($container) {
    return new Love;
})

$container->show();
$superman_4 = $container->make('superman', array('love'));
$superman_4->fight();
exit;

// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('xpower', function($container) {
    return new XPower;
});

// 同上
$container->bind('ultrabomb', function($container) {
    return new UltraBomb;
});

$love = new Love();
$container->bind('love', $love);

// ****************** 华丽丽的分割线 **********************
echo '<pre>';
// 开始启动生产
$superman_1 = $container->make('superman', array('xpower'));
$superman_2 = $container->make('superman', array('ultrabomb'));
$superman_3 = $container->make('superman', array('love'));


$superman_1->fight();
$superman_2->fight();
$superman_3->fight();
