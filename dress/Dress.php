<?php

include_once('Icomponent.php');

// 理解为装饰类的基类
class Dress implements Icomponent {
	protected $component_obj;

	public function setcomponent ($component_obj) {
		$this->component_obj = $component_obj;
	}

	public function operation () {
		if ($this->component_obj != NULL) {
			$this->component_obj->operation();
		}
	}
}