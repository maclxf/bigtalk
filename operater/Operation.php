<?php

// 运算的父类提供基本的四种运算方法 + - * /
abstract class Operation {
	public $first;
	public $sec;

	public function __construct($first, $sec) {

		$this->first = $first;
		$this->sec = $sec;
	}

	abstract function getresult();
}