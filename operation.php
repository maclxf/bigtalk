<?php
echo time();
	include_once('operater/Choseoperater.php');

	$action = '+';
	$number1 = '1';
	$number2 = '2';

	$operater = new Choseoperater();


	$operat = $operater->getoperater($action);

	if ($operater) {
		if ($action  && $number1  && $number2 ) {
			echo $operater->getresult($number1, $number2);
		} else {
			echo '请你算算！！';
		}
	} else {
		echo '晓得囊个算哦！';
	}
