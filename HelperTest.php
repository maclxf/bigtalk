<?php
require_once('Toolise/Helper.php');

var_dump(rand_pswd());
$item = [
	'pos' => 'CQ'
];

$arr = [
	[
		'name' => 'lxf',
		'age' => 18,
	],
	[
		'name' => 'mm',
		'age' => 18,
	]
];

$ret = array_each_add_item($item, $arr);

var_dump($ret);

echo '<hr>';

//////////////////////////////////////////////////

$color = [
	'红色',
	'黄色'
];

$memory = [
	'16G',
	'32G'
];

$lock = [
	'有锁',
	'无锁'
];

$ret = array_map(null, $color, $memory, $lock);

$phones = array_map(function($phone) {
	return implode($phone, '-');
}, $ret);

var_dump($phones);

//////////////////////////////////////////////////

var_dump(strtotime('2018-10-26'));
var_dump(strtotime('2019-05-04'));

$a = strtotime('2019-05-04') - strtotime('2018-10-26');

var_dump($a/24*60*60);

echo '<hr>';

//////////////////////////////////////////////////
$userdb = array(
    0 => array(
            'uid' => 100,
            'name' => 'Sandra Shush',
            'url' => 'urlof100'
        ),

    '8' => array(
            'uid' => 5465,
            'name' => 'Stefanie Mcmohn',
            'pic_square' => 'urlof100'
        ),

    '3' => Array(
            // 'uid' => 5555,
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        ),

    '6' => Array(
            'uid' => 40489,
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        )
);

$uid = 40489;
$ret = array_find($userdb, function($value, $key) use($uid) {
	if (isset($value['uid']) && $value['uid'] == $uid) {
		return true;
	}
});

var_dump($ret);
echo '<hr>';

//////////////////////////////////////////////////
$userdb = array(
    0 => array(
            'uid' => 100,
            'name' => 'Sandra Shush',
            'url' => 'urlof100'
        ),

    '8' => array(
            'uid' => 5465,
            'name' => 'Stefanie Mcmohn',
            'pic_square' => 'urlof100'
        ),

    '3' => Array(
            // 'uid' => 5555,
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        ),

    '6' => Array(
            'uid' => 40489,
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        )
);
$ret = array_first($userdb, function($val, $key) {
	if (isset($val['uid']) && $val['uid'] > 100) {
		return $val;
	}
}, ['bullshit']);

var_dump($ret);






