<?php
require_once './poly/Student.php';
require_once './poly/Officer.php';
require_once './poly/People.php';


$s = new People(new Student());
$s->doing();
ECHO '<BR>';
$w = new People(new Officer());
$w->doing();


