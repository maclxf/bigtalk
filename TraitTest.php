<?php
require_once('./vendor/autoload.php');
/**
 *
 */
trait A
{
    public function bigtalk()
    {
        echo __METHOD__;
    }

    public function smallTalk()
    {
        echo __METHOD__;
    }
}

trait B
{
    public function bigtalk()
    {
        echo __METHOD__;
    }

    public function smallTalk()
    {
        echo __METHOD__;
    }
}

class Base
{
    public function bigtalk()
    {
        echo 111;
    }
}

class P extends Base
{
    use A, B {
        B::bigtalk insteadof A;
        A::smallTalk insteadof B;
    }
    // public function bigtalk()
    // {
    //     echo __METHOD__;
    // }
}

$p = new P();
// 自己的方法 > trait 的方法 > 集成的方法
$p->bigtalk();


dump(date('Y-m-d 00:00:00', strtotime('yesterday')) . '---' . date('Y-m-d 23:59:59', strtotime('yesterday')));
dump(date('Y-m-d 00:00:00', strtotime('-7days')) . '---' . date('Y-m-d 23:59:59', strtotime('-7days')));
dump(date('Y-m-d 00:00:00', strtotime('-30days')) . '---' . date('Y-m-d 23:59:59', strtotime('-30days')));


$coupons = [
    [
        'sid' => 'gd2001',
        'require' => 200,
        'value' => 50,
    ],
    [
        'sid' => 'gd2003',
        'require' => 0,
        'value' => 5,
    ],
    [
        'sid' => 'gd2004',
        'require' => 120,
        'value' => 98,
    ],
    [
        'sid' => 'gd2002',
        'require' => 30,
        'value' => 25,
    ],
    [
        'sid' => 'gd2005',
        'require' => 100,
        'value' => 90,
    ],
];

$sids = [
    'gd2003',
    'gd2005',
    'gd2002',
    'gd2004',
    'gd2001'
];

$discount = array_map(function($coupon) {
    $coupon['discount'] = 0;
    if ($coupon['require'] > 0) {
        $coupon['discount'] = ($coupon['require'] - $coupon['value']) / $coupon['require'];
    }
    return $coupon['discount'];
}, $coupons);

$discount = array_filter($discount, function($coupon) {
    return $coupon['discount'] <= 0.2;
});

sort($discount);

dump($discount);


$arrangeCoupons = [];
$coupons = array_column($coupons, null, 'sid');
foreach($sids as $sid) {
    $arrangeCoupons[$sid] = $coupons[$sid];
}

dump($arrangeCoupons);