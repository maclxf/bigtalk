<?php
require_once __DIR__ . '/vendor/autoload.php';
use PragmaRX\Countries\Package\Countries;

$countries = new Countries();

$all = $countries->where('cca2', 'FR')->first()
    ->hydrate('cities')
    ->cities
    ->paris;
var_dump($all);
// $all = $countries->where('cca2', 'JP')->first()
//     ->hydrate('cities')
//     ->cities
//     ->paris
//     ->timezone;
// var_dump($all);
