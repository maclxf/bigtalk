<?php
	include_once('operater/Choseoperater.php');

	$action = '+';
	$number1 = '1';
	$number2 = '2';

	$choseoperater = new Choseoperater();

	if ($choseoperater) {
		$operater = $choseoperater->getoperater($action);

		if ($action  && $operater ) {
			echo $operater->getresult($number1, $number2);
		} else {
			echo '请你算算！！';
		}
	} else {
		echo '晓得囊个算哦！';
	}
