<?php
namespace Componet;

abstract class File implements IFile
{
	public $name;

	public function __construct($name) {
		$this->name = $name;
	}

	public function add() {
		return false;
	}

	public function remove() {
		return false;
	}

	public function getChild() {
		return [];
	}

	public function display() {
		echo $this->name;
	}

}