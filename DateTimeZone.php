<?php
require_once __DIR__ . '/vendor/autoload.php';
$dater = new Dater\Dater(new Dater\Locale\En());
var_dump(timezone_name_get());
$dater->setServerTimezone('Europe/Paris');
$dater->setClientTimezone('Asia/Tokyo');
$time = '2020-03-17 13:55:48';
echo '<pre>';

var_dump($dater->serverDatetime($time)); // 2013-03-21 08:18:06
var_dump($dater->isoDatetime($time)); // 2013-03-21 04:18:06
var_dump($dater->time($time)); // 04:18


function date_to_local($time_str) {

}