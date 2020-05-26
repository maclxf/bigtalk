<?php
namespace Space;

include 'App1/User.php';
include 'App2/User.php';

// use Space\App1\User;
// use Space\App2\User as A2User;

// echo User::make() . PHP_EOL;
// echo A2User::make();

/**********************************/

// use Space\App1;
// use Space\App2;

// echo App1\User::make() . PHP_EOL;
// echo App2\User::make();

/**********************************/

echo App1\User::make() . PHP_EOL;
echo App2\User::make();

//use Space\App1\show_helper;

// function show_helper() {
//     echo 'space helper' . PHP_EOL;
// }

// show_helper(); 

// \show_helper();
