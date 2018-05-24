<?php
/**
 * + 键名重复时保留前一个，不会重新索引也不会改变两个数组中值的位置
 *
 * array_merge
 * 		1  键名是字符串：重复时后面覆盖前面的
 * 		2  键名是数字： 重复时后面的将叠加到后面（因为数组已被重新索引）
 */

/*$staffPart1 = [
	'lx' => [
		'sex' => 'male',
		'age' => 18
	],
	'cz' => [
		'sex' => 'male',
		'age' => 19
	],
];

$staffPart2 = [
	'lb' => [
		'sex' => 'male',
		'age' => 20
	],
	'yl' => [
		'sex' => 'male',
		'age' => 21
	],
	'lx' => [
		'sex' => 'male',
		'age' => 23,
	],
];

echo '<pre>';
// 当键名是字符串时有重复那么前面一个将被后面一个覆盖
//$all_merge = array_merge($staffPart1, $staffPart2);

// 当键名相同时，只会保留前面一个，当键名不同时，那么最会叠加两个数组，不会重新索引也不会改变两个数组中值的位置
$all_plus = $staffPart1 + $staffPart2;
var_dump($all_plus);*/

/*******************************************************************************/

/*$staffPart1 = [
	1 => [
		'name' => 'lx',
		'sex' => 'male',
		'age' => 18
	],
	2 => [
		'name' => 'cz',
		'sex' => 'male',
		'age' => 19
	],
];

$staffPart2 = [
	3 => [
		'name' => 'lb',
		'sex' => 'male',
		'age' => 20
	],
	4 => [
		'name' => 'yl',
		'sex' => 'male',
		'age' => 21
	],
	1 => [
		'name' => 'lx',
		'sex' => 'male',
		'age' => 23,
	],
];

//数组包含数字键名，后面的值将不会覆盖原来的值，而是附加到后面（因为已经被重新索引了）。
$all = array_merge($staffPart1, $staffPart2);

echo '<pre>';
//var_dump($all);

$all_plus = $staffPart1 + $staffPart2;
var_dump($all_plus);*/


/*******************************************************************************/

// 如果只给了一个数组并且该数组是数字索引的，则键名会以连续方式重新索引。
/*$staffPart2 = [
	3 => [
		'name' => 'lb',
		'sex' => 'male',
		'age' => 20
	],
	4 => [
		'name' => 'yl',
		'sex' => 'male',
		'age' => 21
	],
	1 => [
		'name' => 'lx',
		'sex' => 'male',
		'age' => 23,
	],
];

$Part2 = array_merge($staffPart2);
echo '<pre>';
var_dump($Part2);*/

/*******************************************************************************/

$staffPart1 = [
	1 => [
		'name' => 'lx',
		'sex' => 'male',
		'age' => 18
	],
	'ap' => [
		'name' => 'ap',
		'sex' => 'male',
		'age' => 19
	],
];

$staffPart2 = [
	3 => [
		'name' => 'lb',
		'sex' => 'male',
		'age' => 20
	],
	'ap' => [
		'name' => 'ap',
		'sex' => 'male',
		'age' => 21
	],
	1 => [
		'name' => 'lx',
		'sex' => 'male',
		'age' => 23,
	],
];

$all = array_merge($staffPart1, $staffPart2);

echo '<pre>';
var_dump($all);

$all_plus = $staffPart1 + $staffPart2;
var_dump($all_plus);
