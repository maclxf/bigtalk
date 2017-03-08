<?php

include_once('Dress_v1.php');

class DressA_v1 extends Dress_v1 {
	protected $color;

	public function set_color($color) {
		$this->color = $color;
	}

	public function show() {
		parent::show();
		echo $this->color . 'T-shirt ';
	}
}