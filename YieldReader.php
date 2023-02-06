<?php
$file_path = 'INVOIC.823499.20190207.095745';

function readTxt($file_path) {
    $f = fopen($file_path, 'r');
    try {
        while($line = fgets($f)) {
            yield $line;
            //return 'a';
        }
    } finally {
        fclose($f);
    }
}
$start = memory_get_usage();
//$data = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$a = readTxt($file_path);
// try {
//     //code...
//     echo $a->getReturn();
// } catch (\Throwable $th) {
//     echo $th->getMessage();//throw $th;
// }
foreach ($a as $key => $value) {
    echo $key . '=>' . $value;
}
$end = memory_get_usage();
var_dump(($end - $start) / 1024);