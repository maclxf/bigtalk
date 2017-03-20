<?php
require_once 'Factory.php';
require_once '../AddOpreator.php';

class AddFactory extends Factory {
	public function OpreatorCreater(int $NumberA, int $NumberB) {
		return new AddOpreator($NumberA, $NumberB);
	}
}