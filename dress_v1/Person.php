<?php

class Person {
	protected $name;

	public function name ($name) {
		$this->name = $name;
	}

	public function show() {
		echo $this->name . ' 穿的是 ';
	}
}

// 提供一个需要装饰的对象