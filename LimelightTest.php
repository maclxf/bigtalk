<?php
require_once __DIR__ . '/vendor/autoload.php';



$limelight = new Limelight();
$results = $limelight->parse('庭でライムを育てています。');
