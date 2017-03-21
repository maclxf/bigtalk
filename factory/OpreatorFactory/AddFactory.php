<?php
class AddFactory extends Factory {
	public function OpreatorCreater($NumberA, $NumberB) {
		return new AddOpreator($NumberA, $NumberB);
	}
}