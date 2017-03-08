<?php

include_once('Person.php');

class Dress_v1 extends Person {
	protected $person;
	public function setcomponent($person_obj) {
		$this->person = $person_obj;
	}

	public function show() {
		if ($this->person != NULL) {
			$this->person->show();
		}
	}
}