<?php


include_once('Operationadd.php');
include_once('Operationsub.php');
include_once('Operationmultip.php');
include_once('Operationdiv.php');

class Choseoperater {

	protected $first;
	protected $sec;

	public function __construct($first = NULL, $sec = NULL) {
		$this->first = $first;
		$this->sec = $sec;
	}

	public function getoperater($operat) {
		switch ($operat) {
			case '+':
				$operater = new Operationadd($this->first, $this->sec);
				break;
			case '-':
				$operater = new Operationsub($this->first, $this->sec);
				break;
			case '*':
				$operater = new Operationmultip($this->first, $this->sec);
				break;
			case '/':
				$operater = new Operationdiv($this->first, $this->sec);
				break;
			default:
				$operater = NULL;
				break;
		}
		return $operater;
	}
}

