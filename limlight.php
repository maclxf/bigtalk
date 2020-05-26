<?php
require_once __DIR__ . './vendor/autoload.php';

// 方案一
/*$text = "私は走りながら考えるエンジニアです。";
$exe_path = 'C:/"Program Files"/MeCab/bin/mecab.exe';
$descriptorspec = array(
      0 => array("pipe", "r")
    , 1 => array("pipe", "w")
);
$process = proc_open($exe_path, $descriptorspec, $pipes);
if (is_resource($process)) {
    fwrite($pipes[0], $text);
    fclose($pipes[0]);
    $result = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    proc_close($process);
}
echo "<pre>";
echo $text;
'<br>';
print_r($result);
echo "</pre>";*/

// 方案二

use Yubako2\Convert2Romaji\Convertor as Convert2Romaji;

echo Convert2Romaji::convert('感じ取れたら手を繋ごう、重なるのは人生のライン レミリア最高！');


