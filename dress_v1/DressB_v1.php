<?php

include_once('Dress_v1.php');

class DressB_v1 extends Dress_v1 {
	protected $style;

	public function set_style($style) {
		$this->style = $style;
	}

	public function show() {
		parent::show();
		echo $this->style . '短裤';
	}
}