<?php
# Yield 对比效果
// $start = memory_get_usage();

// function yield_range($start, $end) {
//     while($start <= $end) {
//         $start++;
//         yield $start;
//     }
// }

// foreach( yield_range( 0, 9999 ) as $item ){
//     echo $item.',';
// }
// $end = memory_get_usage();
// echo ($end - $start) / 1024;

// foreach(yield_range(0,9) as $v) {
//     echo $v.PHP_EOL;
// }
// var_dump(yield_range(0, 9));

// $start = memory_get_usage();
// $a = range(1, 10000);
// foreach($a as $v) {
//     //echo $v;
// }
// $end = memory_get_usage();
//echo ($end - $start) / 1024;




