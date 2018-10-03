<?php

namespace SimpleIntense;

class SimpleIntense
{

	static public $instance;

	private $name;

	private function __construct($name) {
		$this->name = $name;
	}

	public function __clone() {

	}

	public function getName() {
		echo $this->name;
	}

	static public function getInstance($name) {
		if (!self::$instance instanceof self) {
			self::$instance = new self($name);
		}

		return self::$instance;
	}



	/*static private $si;

	private $name;

	static public function getInstance($name)
	{
		if (!self::$si instanceof self) {
			self::$si = new self($name);
		}

		return self::$si;
	}

	private function __construct($name)
	{
		$this->name = $name;
	}

	private function __clone() {

	}

	public function getName() {
		echo $this->name;
	}*/
}